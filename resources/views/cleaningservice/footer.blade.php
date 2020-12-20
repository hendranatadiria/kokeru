<footer class="app-footer d-print-none">
      </footer>

      <script type="text/javascript">
    /* Recover sidebar state */
    if (Boolean(sessionStorage.getItem('sidebar-collapsed'))) {
      var body = document.getElementsByTagName('body')[0];
      body.className = body.className.replace('sidebar-lg-show', '');
    }

    /* Store sidebar state */
    var navbarToggler = document.getElementsByClassName("navbar-toggler");
    for (var i = 0; i < navbarToggler.length; i++) {
      navbarToggler[i].addEventListener('click', function(event) {
        event.preventDefault();
        if (Boolean(sessionStorage.getItem('sidebar-collapsed'))) {
          sessionStorage.setItem('sidebar-collapsed', '');
        } else {
          sessionStorage.setItem('sidebar-collapsed', '1');
        }
      });
    }
  </script>

  <script type="text/javascript" src="http://localhost:8000/packages/backpack/base/js/bundle.js?v=4.1.27@bd1bab5dde08df20eebd730ca3a2992e1bf334f7"></script>
    

<script type="text/javascript">
  Noty.overrideDefaults({
    layout   : 'topRight',
    theme    : 'backstrap',
    timeout  : 2500, 
    closeWith: ['click', 'button'],
  });

  </script>
<!-- page script -->
<script type="text/javascript">
    // To make Pace works on Ajax calls
    $(document).ajaxStart(function() { Pace.restart(); });

    // Ajax calls should always have the CSRF token attached to them, otherwise they won't work
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    
    var activeTab = $('[href="' + location.hash.replace("#", "#tab_") + '"]');
    location.hash && activeTab && activeTab.tab('show');
    $('.nav-tabs a').on('shown.bs.tab', function (e) {
        location.hash = e.target.hash.replace("#tab_", "#");
    });
</script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.js" integrity="sha512-UHlZzRsMRK/ENyZqAJSmp/EwG8K/1X/SzErVgPc0c9pFyhUwUQmoKeEvv9X0uNw8x46FxgIJqlD2opSoH5fjug==" crossorigin="anonymous"></script><script>
    $(document).on('click','.detailmodal', function(e) {
        $('#detailedModal').modal('show');
    })

    function detectExt(string){
        var ext = string.substring(string.length-3).toLowerCase();
        console.log(ext);
        if (ext=='jpg' || ext=='png' || ext=='tif' || ext=='eic' || ext=='gif') {
            return 'photo';
        } else if (ext == 'mp4' || ext=='mov' || ext=='avi' || ext=='3gp' || ext=='eiv' ) {
            return 'video';
        } else {
            return ext;
        }
    }


    $('#detailedModal').on('shown.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        console.log(button.data('detailid'));
        var id = button.data('detailid')
        var modalBody = $('#bodyModal');
        modalBody.empty();
        modalBody.append('<img src="http://localhost:8000/load.gif" width="40">');
        $.ajax({url: '/admin/cleaninghistory/'+id+'/json', success: function(result){
            modalBody.empty();
            console.log(result.proof_1);
            if(result.proof_1 != null) {
                var type= detectExt(result.proof_1);
                if (type=='photo') {
                    tag='<a href="http://localhost:8000/'+result.proof_1+'" data-lightbox="proof">'+'<img src="http://localhost:8000'+'/'+result.proof_1+'" class="img-fluid proof-crop p-1"></a>';
                } else if (type=='video') {
                    tag='<video width="409" height="230" controls><source src="http://localhost:8000'+'/'+result.proof_1+'">';
                }
                modalBody.append(tag);
            }
            if(result.proof_2 != null) {
                var type= detectExt(result.proof_2);
                if (type=='photo') {
                    tag='<a href="http://localhost:8000/'+result.proof_2+'" data-lightbox="proof">'+'<img src="http://localhost:8000'+'/'+result.proof_2+'" class="img-fluid proof-crop p-1"></a>';
                } else if (type=='video') {
                    tag='<video width="409" height="230" controls><source src="http://localhost:8000'+'/'+result.proof_2+'">';
                }
                modalBody.append(tag);
            }
            if(result.proof_3 != null) {
                var type= detectExt(result.proof_3);
                if (type=='photo') {
                    tag='<a href="http://localhost:8000/'+result.proof_3+'" data-lightbox="proof">'+'<img src="http://localhost:8000'+'/'+result.proof_3+'" class="img-fluid proof-crop p-1"></a>';
                } else if (type=='video') {
                    tag='<video width="409" height="230" controls><source src="http://localhost:8000'+'/'+result.proof_3+'">';
                }
                modalBody.append(tag);
            }
            if(result.proof_4 != null) {
                var type= detectExt(result.proof_4);
                if (type=='photo') {
                    tag='<a href="http://localhost:8000/'+result.proof_4+'" data-lightbox="proof">'+'<img src="http://localhost:8000'+'/'+result.proof_4+'" class="img-fluid proof-crop p-1"></a>';
                } else if (type=='video') {
                    tag='<video width="409" height="230" controls><source src="http://localhost:8000'+'/'+result.proof_4+'">';
                }
                modalBody.append(tag);
            }
            if(result.proof_5 != null) {
                var type= detectExt(result.proof_5);
                if (type=='photo') {
                    tag='<a href="http://localhost:8000/'+result.proof_5+'" data-lightbox="proof">'+'<img src="http://localhost:8000'+'/'+result.proof_5+'" class="img-fluid proof-crop p-1"></a>';
                } else if (type=='video') {
                    tag='<video width="409" height="230" controls><source src="http://localhost:8000'+'/'+result.proof_5+'">';
                }
                modalBody.append(tag);
            }

        }});

    })

    $('#detailedModal').on('hidden.bs.modal', function(){
        $(this).find('video').each(function() {
            this.pause();
        });
    });
</script>
    <script>
      // Set active state on menu element
      var full_url = "http://localhost:8000/admin/dashboard";
      var $navLinks = $(".sidebar-nav li a, .app-header li a");

      // First look for an exact match including the search string
      var $curentPageLink = $navLinks.filter(
          function() { return $(this).attr('href') === full_url; }
      );

      // If not found, look for the link that starts with the url
      if(!$curentPageLink.length > 0){
          $curentPageLink = $navLinks.filter( function() {
            if ($(this).attr('href').startsWith(full_url)) {
              return true;
            }

            if (full_url.startsWith($(this).attr('href'))) {
              return true;
            }

            return false;
          });
      }

      // for the found links that can be considered current, make sure 
      // - the parent item is open
      $curentPageLink.parents('li').addClass('open');
      // - the actual element is active
      $curentPageLink.each(function() {
        $(this).addClass('active');
      });
  </script>





<!-- Footer
<footer class="bg-warning text-black pt-3">
      <div class="container">
        <div class="row text-center">
          <div class="col">
            <p>PeluangBerbicara2020.</p>
          </div>
        </div>
      </div>
    </footer>

  </body>
  </html>
  -->