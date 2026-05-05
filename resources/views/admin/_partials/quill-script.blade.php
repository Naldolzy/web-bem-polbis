<script>
    // =====================================================
    // 1. FIX LINK: Auto-prepend https:// if missing
    // =====================================================
    const LinkFormat = Quill.import('formats/link');
    const originalSanitize = LinkFormat.sanitize.bind(LinkFormat);
    LinkFormat.sanitize = function(url) {
        if (url && url.trim() !== '') {
            url = url.trim();
            // If doesn't start with http/https/mailto/ftp, add https://
            if (!/^(https?:\/\/|mailto:|ftp:|tel:)/i.test(url)) {
                url = 'https://' + url;
            }
        }
        return originalSanitize(url);
    };

    // =====================================================
    // 2. INIT QUILL
    // =====================================================
    const quill = new Quill('#quill-konten', {
        theme: 'snow',
        placeholder: 'Tulis konten lengkap kegiatan di sini...',
        modules: {
            toolbar: {
                container: [
                    [{ 'header': [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'color': [] }, { 'background': [] }],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    [{ 'align': [] }],
                    ['link', 'image', 'blockquote', 'code-block'],
                    ['clean']
                ]
            }
        }
    });

    // =====================================================
    // 3. IMAGE TOOLBAR — Align & Resize
    // =====================================================
    let activeImg = null;
    let imgToolbar = null;

    function removeImgToolbar() {
        if (imgToolbar) { imgToolbar.remove(); imgToolbar = null; }
        if (activeImg) { activeImg.style.outline = ''; activeImg = null; }
    }

    function createImgToolbar(img) {
        removeImgToolbar();
        activeImg = img;
        img.style.outline = '2px solid #1565C0';

        const toolbar = document.createElement('div');
        toolbar.id = 'ql-img-toolbar';
        toolbar.style.cssText = `
            position: absolute;
            display: flex;
            align-items: center;
            gap: 4px;
            background: #0f2d5e;
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 8px;
            padding: 5px 8px;
            z-index: 9999;
            box-shadow: 0 4px 16px rgba(0,0,0,0.4);
            flex-wrap: wrap;
        `;

        const btnStyle = `
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.15);
            color: #93c5fd;
            border-radius: 5px;
            cursor: pointer;
            padding: 3px 8px;
            font-size: 11px;
            font-weight: 600;
            transition: all 0.15s;
        `;

        // Separator
        const sep = () => {
            const s = document.createElement('span');
            s.style.cssText = 'width:1px; height:18px; background:rgba(255,255,255,0.15); margin:0 2px;';
            return s;
        };

        // Alignment buttons
        const alignBtns = [
            { label: '⇤ Kiri',   fn: () => { img.style.display = 'block'; img.style.margin = '8px 0'; img.style.float = 'left'; img.style.clear = 'both'; } },
            { label: '◈ Tengah', fn: () => { img.style.display = 'block'; img.style.margin = '8px auto'; img.style.float = 'none'; img.style.clear = 'both'; } },
            { label: 'Kanan ⇥',  fn: () => { img.style.display = 'block'; img.style.margin = '8px 0 8px auto'; img.style.float = 'right'; img.style.clear = 'both'; } },
        ];
        alignBtns.forEach(({ label, fn }) => {
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.textContent = label;
            btn.style.cssText = btnStyle;
            btn.addEventListener('mouseenter', () => btn.style.background = 'rgba(107,175,42,0.2)');
            btn.addEventListener('mouseleave', () => btn.style.background = 'rgba(255,255,255,0.08)');
            btn.addEventListener('click', (e) => { e.stopPropagation(); fn(); positionToolbar(); });
            toolbar.appendChild(btn);
        });

        toolbar.appendChild(sep());

        // Size buttons
        const sizeBtns = [
            { label: 'S (25%)',  w: '25%'  },
            { label: 'M (50%)',  w: '50%'  },
            { label: 'L (75%)',  w: '75%'  },
            { label: 'Full',     w: '100%' },
        ];
        sizeBtns.forEach(({ label, w }) => {
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.textContent = label;
            btn.style.cssText = btnStyle;
            btn.addEventListener('mouseenter', () => btn.style.background = 'rgba(107,175,42,0.2)');
            btn.addEventListener('mouseleave', () => btn.style.background = 'rgba(255,255,255,0.08)');
            btn.addEventListener('click', (e) => {
                e.stopPropagation();
                img.style.width = w;
                img.style.maxWidth = '100%';
                img.style.height = 'auto';
                positionToolbar();
            });
            toolbar.appendChild(btn);
        });

        toolbar.appendChild(sep());

        // Remove/close button
        const closeBtn = document.createElement('button');
        closeBtn.type = 'button';
        closeBtn.textContent = '✕';
        closeBtn.style.cssText = btnStyle + 'color:#f87171;';
        closeBtn.addEventListener('click', (e) => { e.stopPropagation(); removeImgToolbar(); });
        toolbar.appendChild(closeBtn);

        document.body.appendChild(toolbar);
        imgToolbar = toolbar;
        positionToolbar();
    }

    function positionToolbar() {
        if (!activeImg || !imgToolbar) return;
        const rect = activeImg.getBoundingClientRect();
        const scrollY = window.scrollY || document.documentElement.scrollTop;
        imgToolbar.style.left = Math.max(8, rect.left) + 'px';
        imgToolbar.style.top  = (rect.top + scrollY - imgToolbar.offsetHeight - 8) + 'px';
    }

    // Listen for image clicks inside Quill editor
    quill.root.addEventListener('click', function(e) {
        if (e.target.tagName === 'IMG') {
            createImgToolbar(e.target);
        } else {
            removeImgToolbar();
        }
    });

    // Remove toolbar if clicking outside
    document.addEventListener('click', function(e) {
        if (imgToolbar && !imgToolbar.contains(e.target) && e.target !== activeImg) {
            removeImgToolbar();
        }
    });

    // Reposition on scroll
    document.querySelector('.main-content')?.addEventListener('scroll', positionToolbar);
    window.addEventListener('scroll', positionToolbar, true);

    // =====================================================
    // 4. TOOLTIP OVERFLOW FIX
    // =====================================================
    quill.on('selection-change', function() {
        setTimeout(() => {
            const tooltip = document.querySelector('.ql-tooltip');
            if (!tooltip || tooltip.style.display === 'none') return;
            const rect = tooltip.getBoundingClientRect();
            const container = document.getElementById('quill-konten-container').getBoundingClientRect();
            if (rect.bottom > window.innerHeight) {
                tooltip.style.top = (parseFloat(tooltip.style.top) - rect.height - 30) + 'px';
            }
            if (rect.right > container.right) {
                tooltip.style.left = (container.width - rect.width - 8) + 'px';
            }
            if (rect.left < container.left) {
                tooltip.style.left = '0px';
            }
        }, 60);
    });

    // =====================================================
    // 5. SUBMIT — copy Quill HTML to hidden input
    // =====================================================
    document.getElementById('form-kegiatan').addEventListener('submit', function() {
        removeImgToolbar();
        document.getElementById('konten-hidden').value = quill.root.innerHTML;
    });

    lucide.createIcons();
</script>
