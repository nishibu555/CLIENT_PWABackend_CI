 <!-- Footer -->
 <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="logout">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <!-- <script src="<?php echo base_url()?>assets/vendor/jquery/jquery.min.js"></script> -->
  <script src="<?php echo base_url()?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url()?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo base_url()?>assets/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="<?php echo base_url()?>assets/vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="<?php echo base_url()?>assets/js/demo/chart-area-demo.js"></script>
  <script src="<?php echo base_url()?>assets/js/demo/chart-pie-demo.js"></script>
  <script src="<?php echo base_url()?>assets/js/notify.min.js"></script>
  <script src="<?php echo base_url()?>assets/alertifyjs/alertify.min.js"></script>




    <!-- Page level custom scripts -->


<script>
  <?php if($this->session->flashdata('success')){?>
    alertify.set('notifier','position', 'top-right');
  alertify.notify('<p style="color:#ffffff"><?php echo $this->session->flashdata('success'); ?></p>', 'success', 5, function(){  console.log('dismissed'); });

<?php } ?>

  <?php if($this->session->flashdata('error')){?>
    alertify.set('notifier','position', 'top-right');
  alertify.notify('<p style="color:#ffffff"><?php echo $this->session->flashdata('error'); ?></p>', 'error', 5, function(){  console.log('dismissed'); });

<?php } ?>


$(document).ready(function(){
  <?php $_SESSION['sec_file_info'] = array(); ?>
})
</script>
</body>

</html>
