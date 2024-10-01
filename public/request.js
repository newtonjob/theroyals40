"use strict";

(function () {
    const css = document.createElement('link');
    css.rel = 'stylesheet';
    css.type = 'text/css';
    css.href = 'https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css';

    const script = document.createElement('script');
    script.src = 'https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js';

    const swal = document.createElement('script');
    swal.src = 'https://unpkg.com/sweetalert@2.1.2/dist/sweetalert.min.js';

    document.head.appendChild(css).appendChild(script).appendChild(swal);

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

const notify = () => window.notify ??= new Notyf({
    position: { x: 'right', y: 'top' },
    duration: 8000,
    dismissible: true,
})

const submitForm = (form, controller = null) => {
    loadSpinner(form);

    return axios.post(form.action, form, { signal: controller?.signal })
        .then(response => {
            if (response.headers['x-location']) {
                location.href = response.headers['x-location'];
            }

            if (response.data.message && ! form.dataset.hasOwnProperty('quietly')) {
                notify().success(response.data.message);
            }

            closeModals();

            dispatch('then', form, response.data);
        }).catch(error => {
            notify().error(error.response?.data?.message ?? error.message);

            dispatch('catch', form, error);

            return Promise.reject(error)
        }).finally(() => {
            removeSpinner(form);

            dispatch('finally', form);
        });
}

const dispatch = (event, el, data) => {
    el.dispatchEvent(new CustomEvent(event, { detail: data, bubbles: true }));
}

const loadSpinner = (form) => {
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

const removeSpinner = (form) => {
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
    Alpine.magic('submit', el => {
        return () => {
            if (el.dataset.hasOwnProperty('confirm')) {
                return confirmBeforeSubmit(el);
            }

            return submitForm(el);
        }
    });

    ["error", "success"].forEach((type) => {
        Alpine.magic(type, () => {
            return (subject) => notify()[type](subject);
        });
    });
});

const confirmBeforeSubmit = (el) => {
    const [text, title] = el.dataset.confirm.split('|');

    return swal({
        title: title ?? "Sure?",
        text: text || "Are you sure you would like to do this?",
        icon: "warning",
        buttons: ['Nevermind', {
            text: el.dataset.confirmBtn ?? "Yes, proceed",
            closeModal: false,
        }],
        dangerMode: JSON.parse(el.dataset.danger ?? true)
    }).then(confirm => {
        if (confirm) {
            const controller = new AbortController();

            submitForm(el, controller).finally(() => swal.close());

            document.querySelector('.swal-button--cancel').addEventListener(
                'click', () => controller.abort()
            );
        }
    });
}

const closeModals = () => {
    try {
        $('.modal').modal('hide');
        // $('.modal-backdrop').hide();
    } catch(e) {
        //
    }
}
