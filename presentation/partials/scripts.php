<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD6QjagZ_Np5GWyiM5ZXo-Vv3klQwVhM0g">
</script>
<script src="https://www.google.com/recaptcha/api.js?render=6LcIO6QUAAAAAC6ULdO99fN0JzQUvJhqU5xuoPAz"></script>
<script src="https://www.paypal.com/sdk/js?client-id=AWhNrBCEro6WUoG1wbUb6b6AvghyOGGTg2wR0c_HXhSI2P4f6r085Bi6okpYaVcVjvf8oIFIUx8mPGQr"></script>

<script>


    // 'SHIPPING ADDRESS IS THE SAME AS MY BILLING ADDRESS' CHECKBOX

    function checkFunc() {

        var shippingField = document.getElementById("checker");
        var checkBox = document.getElementById("defaultUnchecked");

        if (checkBox.checked == true) {

            shippingField.style.display = "none";

        } else {

            shippingField.style.display = "block";

        }
    }

    // GOOGLE MAPS API ON ABOUT US PAGE

    function initMap() {
        // The location of RubberDucktor
        var rubberducktor = {lat: 55.467046, lng: 8.451219};
        // The map, centered at RubberDucktor
        var map = new google.maps.Map(
            document.getElementById('map'), {zoom: 22, center: rubberducktor});
        // The marker, positioned at RubberDucktor
        var marker = new google.maps.Marker({position: rubberducktor, map: map});
    }

    // DELETE MODAL

    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));

        $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
    });
  
   // GOOGLE RECAPTCHA

     grecaptcha.ready(function () {
         grecaptcha.execute('6LcIO6QUAAAAAC6ULdO99fN0JzQUvJhqU5xuoPAz', { action: 'contact' }).then(function (token) {
             var recaptchaResponse = document.getElementById('recaptchaResponse');
             recaptchaResponse.value = token;
         });
     });

    // PAYPAL BUTTON

   

    var amount = document.getElementById("amount");

    paypal.Buttons({
        createOrder: function(data, actions) {
            // Set up the transaction
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '0.2'
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            // Capture the funds from the transaction
            return actions.order.capture().then(function(details) {
                // Show a success message to your buyer
                alert('Transaction completed by ' + details.payer.name.given_name + 'Please click Complete order');

            });
        }
    }).render('#paypal-button-container');
    


</script>
