<?php

namespace App\Support;

use Closure;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Traits\ForwardsCalls;
use Mpdf\Mpdf;
use Mpdf\Output\Destination;

/**
 * @mixin Mpdf
 */
class Pdf
{
    use ForwardsCalls;

    /**
     * The underlying Mpdf instance.
     */
    protected Mpdf $mpdf;

    /**
     * The resulting pdf filename.
     */
    protected string $name = 'file.pdf';

    /**
     * Set the page format for the Pdf.
     */
    public function format($format): static
    {
        config(['pdf.format' => $format]);

        return $this;
    }

    /**
     * Set the margin for the Pdf.
     */
    public function margin($value): static
    {
        config([
            'pdf.margin_left'   => $value,
            'pdf.margin_right'  => $value,
            'pdf.margin_top'    => $value,
            'pdf.margin_bottom' => $value,
        ]);

        return $this;
    }

    public function write($html): static
    {
        $this->boostMemoryLimits();

        $this->getMpdf()->WriteHTML($html);

        return $this;
    }

    /**
     * Get the underlying Mpdf instance or make a new instance.
     */
    public function getMpdf(): Mpdf
    {
        return $this->mpdf ??= app(Mpdf::class);
    }

    public function view($name, $data = []): static
    {
        return $this->write(view($name, $data));
    }

    public function render($name, $data = [])
    {
        return $this->view($name, $data)->stream();
    }

    /**
     * Boost the memory limits to accommodate large PDFs.
     */
    public function boostMemoryLimits(): void
    {
        ini_set("pcre.backtrack_limit", "50000000");
        ini_set('memory_limit', '1024M');
        ini_set('max_execution_time', 120);
    }

    public function stream($name = null)
    {
        if ($name) {
            $this->name($name);
        }

        return $this->getMpdf()->Output($this->name, Destination::INLINE);
    }

    public function download($name = null)
    {
        if ($name) {
            $this->name($name);
        }

        return $this->getMpdf()->Output($this->name, Destination::DOWNLOAD);
    }

    /**
     * Returns the of the generated PDF as a raw string.
     */
    public function string(): string
    {
        return $this->getMpdf()->Output(null, Destination::STRING_RETURN);
    }

    /**
     * A base64 encoded string of the generated PDF.
     */
    public function base64(): string
    {
        return base64_encode($this->string());
    }

    /**
     * Get a sanitized version of the pdf filename.
     */
    public function name(string $name): static
    {
        $this->name = str(preg_replace('/[^a-zA-Z0-9]+/', '-', $name))->finish('.pdf');

        return $this;
    }

    /**
     * Decode the given base64 PDF string and return it as a proper HTTP response.
     */
    public function fromBase64($string): Response
    {
        return response(base64_decode($string))->withHeaders([
            'Content-Type'        => 'application/pdf',
            'Content-disposition' => "inline; filename=\"$this->name\""
        ]);
    }

    /**
     * Get the PDF string from the cache, or execute the given Closure and store the result.
     */
    public function remember($key, $ttl, Closure $callback): Response
    {
        $base64 = Cache::remember($key, $ttl, fn () => $this->write($callback())->base64());

        return $this->fromBase64($base64);
    }

    /**
     * Merge the given pdf file onto the current pdf.
     */
    public function merge(string $file): static
    {
        $pages = $this->setSourceFile($file);

        for ($page = 1; $page <= $pages; $page++) {
            $this->useTemplate($this->importPage($page));

            if ($page < $pages) {
                $this->AddPage();
            }
        }

        return $this;
    }

    /**
     * Dynamically pass missing methods to the Mpdf instance.
     */
    public function __call(string $method, array $parameters)
    {
        return $this->forwardCallTo($this->getMpdf(), $method, $parameters);
    }
}
