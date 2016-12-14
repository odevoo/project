<?php $this->layout('layout', ['title' => 'Formulaire d\'inscription']) ?>

<?php $this->start('main_content') ?>
    <form class="" method="post" action="<?= $this->url('admin_process_register') ?>">
            <div class="form-group">
                <label for="firstname">Prénom</label>
                <input class="form-control"  type="text" name="firstname" id="firstname" placeholder="">
            </div>
            <div class="form-group">
                <label for="lastname">Nom</label>
                <input class="form-control" type="text" name="lastname" id="lastname" placeholder="">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input class="form-control" type="password" name="password" id="password" placeholder="">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control" type="email" name="email" id="email" placeholder="">
            </div>
            <div class="form-group">
                <label for="address">Adresse</label>
                <input type="text" id="autocomplete"  onFocus="geolocate()" class="form-control" name="" value="" placeholder="Adresse">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="btn" value="S'inscrire">
            </div>
            <input type="hidden" name="type" value="student">
            <input type="hidden" name="streetNumber" id="street_number"  value="">
            <input type="hidden" name="address" id="route"  value="">
            <input type="hidden" name="city" id="locality"  value="">
            <input type="hidden" name="zip" id="postal_code"  value="">
            <input type="hidden" name="lat" id="lat"  value="">
            <input type="hidden" name="lng" id="lng"  value="">
    </form>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDVvV3H3-rcwoX6X-Jq1PXMOhiF-6EyO-E&signed_in=true&libraries=places&callback=initAutocomplete"
        async defer></script>
    <script type="text/javascript" src="<?= $this->assetUrl('js/googleplace.js') ?>"></script>
<?php $this->stop('main_content') ?>
