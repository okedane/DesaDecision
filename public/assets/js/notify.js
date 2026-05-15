// Minimal vanilla notify implementation
(function () {
    if (window.notify) return;

    const css = `
    #notify-container{position:fixed;top:1rem;right:1rem;z-index:2000;display:flex;flex-direction:column;gap:0.5rem;}
    .notify{min-width:220px;padding:0.65rem 0.9rem;border-radius:8px;color:#fff;box-shadow:0 6px 18px rgba(0,0,0,0.12);opacity:0;transform:translateY(-8px);transition:all .22s ease;display:flex;align-items:flex-start;justify-content:space-between;gap:0.5rem}
    .notify.show{opacity:1;transform:none}
    .notify .msg{flex:1;font-size:0.9rem;line-height:1.2}
    .notify .close{background:transparent;border:0;color:rgba(255,255,255,0.9);font-size:1.1rem;cursor:pointer}
    .notify.success{background:#198754}
    .notify.error{background:#dc3545}
    .notify.warning{background:#fd7e14}
    .notify.info{background:#0d6efd}
    `;

    const style = document.createElement('style');
    style.setAttribute('data-notify','true');
    style.appendChild(document.createTextNode(css));
    document.head.appendChild(style);

    const container = document.createElement('div');
    container.id = 'notify-container';
    if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', () => document.body.appendChild(container));
    else document.body.appendChild(container);

    window.notify = function (opts) {
        if (!opts) return;
        const type = (opts.type || 'info');
        const message = opts.message || '';

        const el = document.createElement('div');
        el.className = 'notify ' + type;

        const msg = document.createElement('div');
        msg.className = 'msg';
        msg.innerHTML = message;

        const btn = document.createElement('button');
        btn.className = 'close';
        btn.type = 'button';
        btn.innerHTML = '&times;';

        btn.addEventListener('click', remove);

        function remove() {
            el.classList.remove('show');
            setTimeout(function () { try { el.remove(); } catch (e) {} }, 250);
        }

        el.appendChild(msg);
        el.appendChild(btn);
        container.appendChild(el);

        // show
        setTimeout(function () { el.classList.add('show'); }, 10);

        // auto remove
        setTimeout(remove, (opts.timeout || 5000));
        return el;
    };

    function readFlashValue(value) {
        if (!value || value === 'null' || value === '""') return '';
        try {
            return JSON.parse(value);
        } catch (e) {
            return value;
        }
    }

    function renderFlashMessages() {
        const flash = document.getElementById('flash-notify');
        if (!flash) return;

        const success = readFlashValue(flash.getAttribute('data-success'));
        const error = readFlashValue(flash.getAttribute('data-error'));
        const errors = readFlashValue(flash.getAttribute('data-errors')) || [];

        if (success) window.notify({ type: 'success', message: success });
        if (error) window.notify({ type: 'error', message: error });
        if (Array.isArray(errors) && errors.length) {
            window.notify({ type: 'warning', message: errors.join('<br>') });
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', renderFlashMessages);
    } else {
        renderFlashMessages();
    }
})();
