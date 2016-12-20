<?php $this->layout('layout', ['title' => 'Settings']) ?>

<?php $this->start('main_content') ?>
        <h2>Modifier votre profil</h2>
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
                <label for="password">Verification password</label>
                <input class="form-control" type="password" name="password" id="password" placeholder="">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control" type="email" name="email" id="email" placeholder="">
            </div>
            <div class="form-group">
                <label for="address">Adresse</label>
                <input type="text" id="autocomplete"  onFocus="geolocate()" class="autocomplete form-control" name="" value="" placeholder="Adresse">
            </div>
            <div class="form-group">
                <label for="avatar">Modifier votre avatar</label>
                <input class="form-control" type="file" name="file" id="file" placeholder="">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="btn" value="Modifier mes informations">
            </div>
            <input type="hidden" name="type" value="student">
            <input type="hidden" name="streetNumber" id="autocomplete_street_number"  value="">
            <input type="hidden" name="address" id="autocomplete_route"  value="">
            <input type="hidden" name="city" id="autocomplete_locality"  value="">
            <input type="hidden" name="zip" id="autocomplete_postal_code"  value="">
            <input type="hidden" name="lat" id="autocomplete_lat"  value="">
            <input type="hidden" name="lng" id="autocomplete_lng"  value="">
        </form>
    </div>

    
<?php $this->stop('main_content') ?>