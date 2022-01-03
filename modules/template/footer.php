  


  
    <footer class="main-footer">
        <strong>Copyright &copy; 2020 - <a href="https://kec-larangan.tangerangkota.go.id/">Kecamatan Larangan</a>.</strong>
    </footer>
    </div><!-- ./wrapper -->

 <!-- jQuery -->
<script src="assets/plugins/jquery/jquery.js"></script>
<!-- Bootstrap-->
<script src="assets/js/bootstrap.js"></script>
<!-- ChartJS -->
<script src="assets/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="assets/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="assets/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="assets/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="assets/plugins/datepicker/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="assets/plugins/moment/moment.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="assets/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/js/adminlte.js"></script>
<!-- DataTables -->
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="assets/calender/js/pignose.calendar.js"></script>
<script src="assets/js/jquery.autocomplete.min.js"></script>
<script>
  $(function () {
    $("#dataTb1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#dataTb2').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": false,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });

  $(function(){
  $(".datepicker").datepicker({
      locale: 'ind',
      format: 'yyyy-mm-dd',
      autoclose: true,
      todayHighlight: true,
  });
 });

 //jquery autocomplete

 $( "#kode" ).autocomplete({
        serviceUrl: "include/kode.php",   // Kode php untuk prosesing data.
        dataType: "JSON",           // Tipe data JSON.
        onSelect: function (suggestion) {
            $( "#kode" ).val(suggestion.kode);
        }
    })
 

$(function() {
      function onClickHandler(date, obj) {
        /**
         * @date is an array which be included dates(clicked date at first index)
         * @obj is an object which stored calendar interal data.
         * @obj.calendar is an element reference.
         * @obj.storage.activeDates is all toggled data, If you use toggle type calendar.
               * @obj.storage.events is all events associated to this date
         */

        var $calendar = obj.calendar;
        var $box = $calendar.parent().siblings('.box').show().delay(3000).slideUp('slow');
        var text = 'Anda memilih tanggal ';

        if(date[0] !== null) {
          text += date[0].format('DD MMMM YYYY');
        }

        if(date[0] !== null && date[1] !== null) {
          text += ' ~ ';
        } else if(date[0] === null && date[1] == null) {
          text += 'tidak ada';
        }

        if(date[1] !== null) {
          text += date[1].format('DD MMMM YYYY');
        }

        $box.text(text);
      }

      $('.calendar').pignoseCalendar({
        lang: 'ind',
        select: onClickHandler,
        theme: 'blue' // light, dark, blue
      });
    });

</script>

<!-- Jquery auto hide untuk menampilkan pesan  -->
<script type="text/javascript">
        $("#alert-message").alert().delay(3000).slideUp('slow');
</script>
  </body>
</html>