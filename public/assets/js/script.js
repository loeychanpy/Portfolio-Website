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
});
