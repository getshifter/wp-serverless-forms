const copy = require('clipboard-copy');
const swal = require('sweetalert2');

export function shifter_dashboard_widget() {
  jQuery(document).ready(
    function($) {

      $("#shifter-support-diag-copy").on("click", function(e) {

        e.preventDefault();

        function CreateIntercomReport() {
          Intercom('showNewMessage', $('#shifter-debug-meta').html());
        }

        let system_report = $('#shifter-debug-meta').text();

        swal({
          title: 'Shifter System Report',
          text: 'Send report to Shifter or copy to your clipboard',
          type: 'info',
          showCancelButton: true,
          confirmButtonColor: '#bc4e9c',
          cancelButtonColor: '#333',
          confirmButtonText: 'Send to Shifter',
          cancelButtonText: 'Copy to Clipboard',
        }).then((result) => {
          if (result.value) {
            CreateIntercomReport();
          } else if (result.dismiss === swal.DismissReason.cancel) {
            copy($('#shifter-debug-meta').text());
            swal(
              'Copied to Clipboard!',
              "Share this report in the <a href='https://support.getshifte.io'>support chat</a> or by email at <a href='mailto:support@getshifter.io'>support@getshifter.io</a>",
              'success'
            )
          }
        })

      });
    }
  );
};
