 <!-- Core JS -->
 <!-- build:js assets/vendor/js/core.js -->
 <script src="{{ asset('template_admin/assets/vendor/libs/jquery/jquery.js') }}"></script>
 <script src="{{ asset('template_admin/assets/vendor/libs/popper/popper.js') }}"></script>
 <script src="{{ asset('template_admin/assets/vendor/js/bootstrap.js') }}"></script>
 <script src="{{ asset('template_admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

 <script src="{{ asset('template_admin/assets/vendor/js/menu.js') }}"></script>
 <!-- endbuild -->

 <!-- Vendors JS -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.2/apexcharts.js" defer></script>
 @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])

 <!-- Main JS -->
 <script src="{{ asset('template_admin/assets/js/main.js') }}"></script>

 <!-- Custom Script -->
 @stack('script')

 <script>
     const resultsList = document.getElementById('results');

     function createLi(searchResult) {
         const li = document.createElement('li');
         const link = document.createElement('a');
         link.href = searchResult.view_link;
         link.textContent = searchResult.match;
         const h4 = document.createElement('h4')
         h4.appendChild(link);
         const span = document.createElement('span');
         //  span.textContent = searchResult.match;
         li.appendChild(h4);
         //  li.appendChild(span);
         return li;
     }
     document.getElementById('search-bar').addEventListener('input', function(event) {
         event.preventDefault();

         const searched = event.target.value;
         fetch('/api/search?search=' + searched, {
             method: 'GET'
         }).then((response) => {
             return response.json();
         }).then((response) => {
             if (resultsList.innerHTML === '') {
                 $(".search-results").removeClass('d-block').addClass('d-none');
             } else {
                 $(".search-results").removeClass('d-none').addClass('d-block');
             }

             const results = response;
             // empty list
             resultsList.innerHTML = '';
             results.forEach((result) => {
                 resultsList.appendChild(createLi(result))
             })
         })
     })
 </script>
