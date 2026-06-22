$(document).ready(function () {

    const savedTheme = localStorage.getItem('theme') || 'dark';
    const $icon = $('#theme-toggle').find('i');
    
    if (savedTheme === 'dark') {
        $icon.removeClass('bi-sun-fill').addClass('bi-moon-fill');
    } else {
        $icon.removeClass('bi-moon-fill').addClass('bi-sun-fill');
    }
  
   $('#theme-toggle').on('click', function() {
        const $html = $('html');
        const currentTheme = $html.attr('data-bs-theme') === 'dark' ? 'light' : 'dark';        
        
        $html.attr('data-bs-theme', currentTheme);
        localStorage.setItem('theme', currentTheme);
        
        
        const $icon = $(this).find('i');
        const $text = $(this).find('#theme-text');
        
        if (currentTheme === 'dark') {
            //  Dark Mode
            $icon.removeClass('bi-sun-fill').addClass('bi-moon-fill');
            $text.text('Dark Mode');
            $(this).removeClass('btn-dark').addClass('btn-primary');
        } else {
            //  Light Mode
            $icon.removeClass('bi-moon-fill').addClass('bi-sun-fill');
            $text.text('Light Mode');
            $(this).removeClass('btn-primary').addClass('btn-dark');
        }
    });


  // Read More toggle 
  $('#read-more-btn').on('click', function (e) {
      e.preventDefault();
      const $moreText = $('#moreText');
      const $btn = $(this);
      
      if ($moreText.is(':visible')) {
          $moreText.slideUp(300, function() {
              $btn.text('Read More');
          });
      } else {
          $moreText.slideDown(300, function() {
              $btn.text('Read Less');
          });
      }
  });

  // Contact form feedback with AJAX and JSON
  $('#contact-form').on('submit', function (e) {
    e.preventDefault();
    
    const $btn = $(this).find('button[type="submit"]');
    const originalText = $btn.text();
    
    // Create JSON object
    const formData = {
        name: $('#name').val(),
        email: $('#email').val(),
        message: $('#message').val(),
        subject: 'Contact Form Message'
    };

    $btn.prop('disabled', true).text('Sending...');
    
    // Send data as JSON
    $.ajax({
        url: CI_BASE_URL + 'contact/send',
        type: 'POST',
        data: JSON.stringify(formData),
        contentType: 'application/json; charset=utf-8',
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                $('#form-message').removeClass('d-none alert-danger').addClass('alert-success').text(response.message);
                $('#contact-form').trigger('reset');
            } else {
                $('#form-message').removeClass('d-none alert-success').addClass('alert-danger').text(response.message);
            }
            $btn.prop('disabled', false).text(originalText);
        },
        error: function() {
            $('#form-message').removeClass('d-none alert-success').addClass('alert-danger').text('Something went wrong. Please try again.');
            $btn.prop('disabled', false).text(originalText);
        }
    });
  });
  
    // Typewriter Effect
    const words = ["Janisha Jaya", "an Informatics Student", "a Creative Explorer"];
    let i = 0;
    let timer;

    function typingEffect() {
        const word = words[i].split("");
        var loopTyping = function() {
            if (word.length > 0) {
                $('#typewriter').append(word.shift());
            } else {
                setTimeout(deletingEffect, 2000); 
                return false;
            }
            timer = setTimeout(loopTyping, 100); 
        };
        loopTyping();
    }

    function deletingEffect() {
        const word = words[i].split("");
        var loopDeleting = function() {
            if (word.length > 0) {
                word.pop();
                $('#typewriter').text(word.join(""));
            } else {
                if (words.length > (i + 1)) {
                    i++;
                } else {
                    i = 0;
                }
                typingEffect();
                return false;
            }
            timer = setTimeout(loopDeleting, 50); 
        };
        loopDeleting();
    }

    
    if ($('#typewriter').length) {
        typingEffect();
    }

    const cards    = Array.from(document.querySelectorAll('.glb-card'));
    const lightbox = document.getElementById('glb-lightbox');
    const lbImg    = document.getElementById('glbImage');
    const lbTitle  = document.getElementById('glbTitle');
    const lbDesc   = document.getElementById('glbDesc');
    const lbCtr    = document.getElementById('glbCounter');
    const lbCap    = document.getElementById('glbCaption');
    const lbDots   = document.getElementById('glbDots');
    const btnClose = document.getElementById('glbClose');
    const btnPrev  = document.getElementById('glbPrev');
    const btnNext  = document.getElementById('glbNext');

    if (!cards.length) return;

    const items = cards.map(c => ({
        src:   c.dataset.src,
        title: c.dataset.title,
        desc:  c.dataset.desc,
    }));

    let current = 0;
    let busy = false;

    /* Build dots */
    items.forEach((_, i) => {
        const d = document.createElement('button');
        d.className = 'glb-lb-dot';
        d.setAttribute('aria-label', 'Go to image ' + (i + 1));
        d.addEventListener('click', () => go(i));
        lbDots.appendChild(d);
    });

    const allDots = () => lbDots.querySelectorAll('.glb-lb-dot');

    function syncDots(i) {
        allDots().forEach((d, j) => d.classList.toggle('active', j === i));
    }

    /* Open */
    function open(idx) {
        current = idx;
        lbImg.src    = items[idx].src;
        lbImg.alt    = items[idx].title;
        lbTitle.textContent = items[idx].title;
        lbDesc.textContent  = items[idx].desc;
        lbCtr.textContent   = (idx + 1) + ' / ' + items.length;
        syncDots(idx);
        lightbox.classList.add('active');
        document.body.style.overflow = 'hidden';
        btnClose.focus();
    }

    /* Close */
    function close() {
        lightbox.classList.remove('active');
        document.body.style.overflow = '';
    }

    /* Navigate with slide animation */
    function go(toIdx, dir) {
        if (busy || toIdx === current) return;
        busy = true;

        const direction = dir ?? (toIdx > current ? 'next' : 'prev');
        const outClass = direction === 'next' ? 'out-left' : 'out-right';
        const inClass  = direction === 'next' ? 'in-left'  : 'in-right';

        lbImg.classList.add(outClass);
        lbCap.classList.add('fading');

        setTimeout(() => {
            lbImg.classList.remove(outClass);
            lbImg.classList.add(inClass);

            current = toIdx;
            lbImg.src           = items[current].src;
            lbImg.alt           = items[current].title;
            lbTitle.textContent = items[current].title;
            lbDesc.textContent  = items[current].desc;
            lbCtr.textContent   = (current + 1) + ' / ' + items.length;
            syncDots(current);

            void lbImg.offsetWidth; /* reflow */
            lbImg.classList.remove(inClass);
            lbCap.classList.remove('fading');

            setTimeout(() => { busy = false; }, 220);
        }, 210);
    }

    function prev() { go((current - 1 + items.length) % items.length, 'prev'); }
    function next() { go((current + 1) % items.length, 'next'); }

    /* Wire cards */
    cards.forEach((card, i) => {
        card.addEventListener('click', () => open(i));
        card.addEventListener('keydown', e => {
            if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); open(i); }
        });
    });

    btnClose.addEventListener('click', close);
    btnPrev.addEventListener('click', prev);
    btnNext.addEventListener('click', next);

    lightbox.addEventListener('click', e => { if (e.target === lightbox) close(); });

    document.addEventListener('keydown', e => {
        if (!lightbox.classList.contains('active')) return;
        if (e.key === 'Escape')     close();
        if (e.key === 'ArrowLeft')  prev();
        if (e.key === 'ArrowRight') next();
    });

    /* Hide nav if only one image */
    if (items.length <= 1) {
        btnPrev.style.display = 'none';
        btnNext.style.display = 'none';
        lbDots.style.display  = 'none';
    }

});

