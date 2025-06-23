
<!-- Footer ================================================================== -->
</div>
<div  style="background-color: #2874a6; color: black"  id="footerSection">
	<div class="container">
		
	  <h4 style="text-align: center; color: #fff">&copy; @php echo date('Y'); @endphp  Buy-PC</h4>
	</div><!-- Container End -->
	</div>
		  <!-- data table JS
		============================================ -->
	<script src="{{ url('data-table/js/data-table/bootstrap-table.js') }}"></script>
    <script src="{{ url('data-table/js/data-table/tableExport.js') }}"></script>
    <script src="{{ url('data-table/js/data-table/data-table-active.js') }}"></script>
    <script src="{{ url('data-table/js/data-table/bootstrap-table-editable.js') }}"></script>
    <script src="{{ url('data-table/js/data-table/bootstrap-editable.js') }}"></script>
    <script src="{{ url('data-table/js/data-table/bootstrap-table-resizable.js') }}"></script>
    <script src="{{ url('data-table/js/data-table/colResizable-1.5.source.js') }}"></script>
    <script src="{{ url('data-table/js/data-table/bootstrap-table-export.js') }}"></script>
	
<!-- Placed at the end of the document so the pages load faster ============================================= -->
	<script src="{{ url('general/themes/js/jquery.js') }}" type="text/javascript"></script>
	<script src="{{ url('general/themes/js/bootstrap.min.js') }}" type="text/javascript"></script>
	<script src="{{ url('general/themes/js/google-code-prettify/prettify.js') }}"></script>
	
	<script src="{{ url('general/themes/js/bootshop.js') }}"></script>
    <script src="{{ url('general/themes/js/jquery.lightbox-0.5.js') }}"></script>
    
      <!-- All Plugins js -->
    <script src="{{ url('menu/js/plugins/plugins.js') }}"></script>
    <!-- Active js -->
    <script src="{{ url('menu/js/active.js') }}"></script>
    
    @yield('editor_footer')


</body>
</html>