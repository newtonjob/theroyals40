"use strict";

let notify;

(function () {
    const css = document.createElement('link');
    css.rel = 'stylesheet';
    css.type = 'text/css';
    css.href = 'https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css';

    const script = document.createElement('script');
    script.src = 'https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js';

    const swal = document.createElement('script');
    swal.src = 'https://unpkg.com/sweetalert@2.1.2/dist/sweetalert.min.js';

    document.head.appendChild(css);
    document.head.appendChild(script);
    document.head.appendChild(swal);

    document.head.insertAdjacentHTML('beforeend',
        `<style>
            @media only screen and (min-width:480px) {
                .notyf__toast { min-width: 420px; }
            }
            .notyf__toast { border-radius: 5px; }
            .notyf__message { font-size: 14px; }
            .notyf__ripple { width: 600px; }
        </style>`
    );
})();

const ensureNotifyIsAvailable = () => {
    if (! notify) {
        notify = new Notyf({
            position: { x: 'right', y: 'top' },
            duration: 8000,
            dismissible: true,
        });
    }
}

const submitForm = (form, controller = null) => {
    ensureNotifyIsAvailable();
    addSpinnerToSubmitButton(form);

    return axios.post(form.action, form, { signal: controller?.signal })
        .then(response => {
            if (response.headers['x-location']) {
                location.href = response.headers['x-location'];
            }

            const data = response.data;

            if (! form.dataset.hasOwnProperty('quietly')) {
                notify.success(data.message);
            }

            closeOpenBootstrapModals();

            dispatch('finish', form, data);
        }).catch(error => {
            notify.error(error.response?.data?.message ?? error.message);

            dispatch('fail', form, error);
        }).finally(() => removeSpinnerFromSubmitButton(form));
}

const dispatch = (event, el, data) => {
    el.dispatchEvent(new CustomEvent(event, { detail: data, bubbles: true }));
}

const addSpinnerToSubmitButton = (form) => {
    let spinner = `
        <svg width="18" viewBox="-2 -2 42 42" xmlns="http://www.w3.org/2000/svg" stroke="white" class="ml-2 x-spinner" style="display: inline-block">
            <g fill="none" fill-rule="evenodd">
                <g transform="translate(1 1)" stroke-width="4">
                    <circle stroke-opacity=".5" cx="18" cy="18" r="18"></circle>
                    <path d="M36 18c0-9.94-8.06-18-18-18">
                        <animateTransform attributeName="transform" type="rotate" from="0 18 18" to="360 18 18" dur="1s" repeatCount="indefinite"></animateTransform>
                    </path>
                </g>
            </g>
        </svg>`;

    let button = getSubmitButtonFor(form);

    if (button) {
        button.insertAdjacentHTML('beforeend', spinner);
        button.disabled = true;
    }
}

const removeSpinnerFromSubmitButton = (form) => {
    let button = getSubmitButtonFor(form);

    if (button) {
        button.querySelector('.x-spinner').remove();
        button.disabled = false;
    }
}

const getSubmitButtonFor = (form) => {
    return form.querySelector('[type=submit], button:not([type])')
        ?? (form.id && document.querySelector('[form='+form.id+']'));
}

document.addEventListener('alpine:init', () => {
    Alpine.directive('submit', el => {
        el.addEventListener('submit', event => {
            event.preventDefault();

            const form = event.target;

            if (form.dataset.hasOwnProperty('confirm')) {
                const [text, title] = form.dataset.confirm.split('|');

                return swal({
                    title: title ?? "Sure?",
                    text: text || "Are you sure you would like to do this?",
                    icon: "warning",
                    buttons: ['Nevermind', {
                        text: form.dataset.confirmBtn ?? "Yes, proceed",
                        closeModal: false,
                    }],
                    dangerMode: JSON.parse(form.dataset.danger ?? true)
                }).then((confirm) => {
                    if (confirm) {
                        const controller = new AbortController();

                        submitForm(form, controller).finally(() => swal.close());

                        document.querySelector('.swal-button--cancel')
                            .addEventListener('click', () => controller.abort());
                    }
                });
            }

            submitForm(form);
        });
    });
});

const closeOpenBootstrapModals = () => {
    try {
        $('.modal').modal('hide');
        $('.modal-backdrop').hide();
    } catch(e) {
        //
    }
}
