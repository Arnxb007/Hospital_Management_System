import './bootstrap';

const ready = (callback) => {
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', callback);
        return;
    }

    callback();
};

ready(() => {
    document.documentElement.classList.add('js-ready');

    const sidebar = document.querySelector('[data-sidebar]');
    const sidebarToggle = document.querySelector('[data-sidebar-toggle]');

    sidebarToggle?.addEventListener('click', () => {
        document.body.classList.toggle('sidebar-open');
        sidebarToggle.classList.toggle('is-active');
    });
    
    document.addEventListener('click', (event) => {
        const target = event.target;

        if (
            document.body.classList.contains('sidebar-open') &&
            sidebar &&
            !sidebar.contains(target) &&
            !sidebarToggle?.contains(target)
        ) {
            document.body.classList.remove('sidebar-open');
            sidebarToggle?.classList.remove('is-active');
        }

const header =
    document.getElementById('ai-suggestions-header');

header?.addEventListener('click', () => {

    const box =
        document.getElementById('ai-suggestions');

    const isHidden =
        window.getComputedStyle(box).display === 'none';

    box.style.display =
        isHidden ? 'flex' : 'none';

});
    });

    const currentPath = window.location.pathname.replace(/\/$/, '') || '/';

    document.querySelectorAll('[data-nav-link]').forEach((link) => {

        const linkPath =
            new URL(link.href)
            .pathname
            .replace(/\/$/, '') || '/';

        if(currentPath === linkPath)
        {
            link.classList.add('is-active');
            link.setAttribute(
                'aria-current',
                'page'
            );
        }

    });

    const revealTargets = document.querySelectorAll(
        '.dashboard-header, .stat-card, .table-card, .info-card, .medical-record-card, .doctor-card, .feature-card, .notification-card'
    );

    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12 });

        revealTargets.forEach((element, index) => {
            element.classList.add('reveal-item');
            element.style.setProperty('--reveal-delay', `${Math.min(index * 45, 360)}ms`);
            observer.observe(element);
        });
    } else {
        revealTargets.forEach((element) => element.classList.add('is-visible'));
    }

    document.querySelectorAll('.stat-number').forEach((element) => {
        const value = Number.parseInt(element.textContent.replace(/[^\d]/g, ''), 10);

        if (Number.isNaN(value)) {
            return;
        }

        let frame = 0;
        const totalFrames = 42;
        const start = 0;

        const animate = () => {
            frame += 1;
            const progress = 1 - Math.pow(1 - frame / totalFrames, 3);
            element.textContent = Math.round(start + (value - start) * progress);

            if (frame < totalFrames) {
                window.requestAnimationFrame(animate);
            } else {
                element.textContent = value;
            }
        };

        animate();
    });

    document.querySelectorAll('button, .add-btn, .search-btn, .reset-btn, .btn-primary, .btn-secondary, .btn-success, .btn-danger, .btn-edit, .btn-back, .action-view, .action-edit').forEach((button) => {
        button.classList.add('interactive-control');

        button.addEventListener('pointerdown', (event) => {
            const ripple = document.createElement('span');
            const rect = button.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);

            ripple.className = 'control-ripple';
            ripple.style.width = `${size}px`;
            ripple.style.height = `${size}px`;
            ripple.style.left = `${event.clientX - rect.left - size / 2}px`;
            ripple.style.top = `${event.clientY - rect.top - size / 2}px`;

            button.appendChild(ripple);
            ripple.addEventListener('animationend', () => ripple.remove());
        });
    });

    document.querySelectorAll('[data-confirm], .delete-btn, .action-delete, form[method="POST"] button[type="submit"].logout-btn').forEach((element) => {
        element.addEventListener('click', (event) => {
            const message = element.dataset.confirm || 'Are you sure you want to continue?';

            if (!window.confirm(message)) {
                event.preventDefault();
            }
        });
    });

    document.querySelectorAll('.modern-table').forEach((table) => {
        const card = table.closest('.table-card');

        if (!card || card.querySelector('[data-table-search]')) {
            return;
        }

        const rows = [...table.querySelectorAll('tbody tr')];

        if (rows.length < 5) {
            return;
        }

        const toolbar = document.createElement('div');
        toolbar.className = 'table-toolbar';
        toolbar.innerHTML = `
            <label class="table-search">
                <span>Search</span>
                <input type="search" data-table-search placeholder="Filter records">
            </label>
        `;

        table.before(toolbar);

        const input = toolbar.querySelector('[data-table-search]');
        input.addEventListener('input', () => {
            const query = input.value.trim().toLowerCase();

            rows.forEach((row) => {
                const match = row.textContent.toLowerCase().includes(query);
                row.hidden = !match;
            });
        });
    });

    document.querySelectorAll('input[type="file"]').forEach((input) => {
        const preview = document.createElement('div');
        preview.className = 'file-preview';
        input.insertAdjacentElement('afterend', preview);

        input.addEventListener('change', () => {
            const file = input.files?.[0];
            preview.textContent = file ? `Selected: ${file.name}` : '';
        });
    });

    document.querySelectorAll('form').forEach((form) => {
        form.addEventListener('submit', () => {
            const submitter = form.querySelector('button[type="submit"], input[type="submit"]');

            if (submitter && !submitter.classList.contains('logout-btn')) {
                submitter.classList.add('is-loading');
                submitter.setAttribute('aria-busy', 'true');
            }
        });
    });
});
const aiBot =
    document.getElementById('ai-bot');

const aiBox =
    document.getElementById('ai-chatbox');

const aiClose =
    document.getElementById('ai-close');

aiBot?.addEventListener('click', () => {

    aiBox.style.display = 'flex';

});

aiClose?.addEventListener('click', () => {

    aiBox.style.display = 'none';

});
document
.getElementById('ai-input')
.addEventListener('keypress', function(e){

    if(e.key === 'Enter')
    {
        e.preventDefault();

        document
        .getElementById('ai-send')
        .click();
    }

});
document
.getElementById('ai-send')
?.addEventListener('click', async () => {

    const input =
        document.getElementById('ai-input');

    const text =
        input.value.trim();

    if(!text) return;

    const messages =
        document.getElementById('ai-messages');

    messages.innerHTML += `
        <div class="user-message">
            ${text}
        </div>
    `;

    input.value = '';

    try {

        const response =
            await fetch('/ai-chat', {

                method:'POST',

                headers:{
                    'Content-Type':'application/json',
                    'X-CSRF-TOKEN':
                    document.querySelector(
                        'meta[name="csrf-token"]'
                    ).content
                },

                body:JSON.stringify({
                    message:text
                })
            });

            const data =
                await response.json();

            let formatted = data.reply
                .replace(/(\d+\.)/g, '<br><strong>$1</strong>')
                .replace(/\n/g, '<br>');

            messages.innerHTML += `
            <div class="ai-message">
            ${formatted}
            </div>
            `;

        messages.scrollTop =
            messages.scrollHeight;

    } catch {

messages.innerHTML += `
<div class="ai-message">
Unable to contact AI Assistant.
</div>
`;

}

});

const suggestions =

document.getElementById('ai-suggestions');
document
.getElementById('ai-suggestions-header')
?.addEventListener('click', function(){

    const suggestions =
        document.getElementById('ai-suggestions');

    suggestions.classList.toggle('collapsed');

    this.innerHTML =
        suggestions.classList.contains('collapsed')
        ? 'Suggested Questions ▶'
        : 'Suggested Questions ▼';

});
const role = window.userRole;

let actions = [];

if(role === 'patient')
{
    actions = [
        'How do I book an appointment?',
        'Download my invoice',
        'View medical records',
        'What is diabetes?',
        'How do notifications work?'
    ];
}
else if(role === 'doctor')
{
    actions = [
        'How do I confirm appointments?',
        'How do I create a medical record?',
        'How do I upload my signature?',
        'How do I manage schedule?',
        'How do notifications work?'
    ];
}
else if(role === 'admin')
{
    actions = [
        'Manage doctors',
        'Manage patients',
        'View reports',
        'Manage appointments',
        'System overview'
    ];
}

suggestions.innerHTML =
actions.map(action => `
<button class="ai-suggestion">
    ${action}
</button>
`).join('');

document.querySelectorAll('.ai-suggestion').forEach(btn => {

    btn.addEventListener('click', () => {

        document.getElementById('ai-input').value =
            btn.innerText;

        document.getElementById('ai-send').click();

        document
        .getElementById('ai-suggestions')
        .classList.add('collapsed');

        document
        .getElementById('ai-suggestions-header')
        .innerHTML = 'Suggested Questions ▶';

    });

});
