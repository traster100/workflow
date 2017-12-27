<form action='' method='get'>

    <div class='row'>
        <div class="col">

            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="type"
                           value="0" <?= $_GET['type'] == 0 ? 'checked' : '' ?> >
                    Search jobs
                </label>
            </div>

            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="type"
                           value="1" <?= $_GET['type'] == 1 ? 'checked' : '' ?> >
                    Search vacancies
                </label>
            </div>

            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="type"
                           value="2" <?= $_GET['type'] == 2 ? 'checked' : '' ?> >
                    Search services
                </label>
            </div>

            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="type"
                           value="3" <?= $_GET['type'] == 3 ? 'checked' : '' ?> >
                    Search freelancers
                </label>
            </div>


            <label>I search in this country</label><br>
            <select id="countries" name="countries_id" class="custom-select">
                <option value="0">All Country</option>
                <?php foreach ($countries_all as $country) {
                    $selected = '';
                    if ($country['id'] == $_GET['countries_id']) {
                        $selected = 'selected';
                    }
                    ?>
                    <option <?= $selected ?> value="<?= $country['id'] ?>"><?= $country['name'] ?></option>
                <?php } ?>
            </select>
            <br>


            <label>I search in this city</label><br>
            <select id="cities" name="cities_id" class="custom-select">
                <option value="0" class='null'>All Cities</option>
                <?php
                if ($_GET['countries_id']) {
                    $this->model_search = new Model_Search();
                    $cities_all = $this->model_search->cities_all($_GET['countries_id']);
                }
                foreach ($cities_all as $city) {
                    $selected = '';
                    if ($city['id'] == $_GET['cities_id']) {
                        $selected = 'selected';
                    }
                    ?>
                    <option <?= $selected ?> value="<?= $city['id'] ?>"><?= $city['name'] ?></option>
                <?php } ?>
            </select>
            <br>


            <label>I search in those categories</label>
            <br>
            <select id="categories" name="categories_id" class="custom-select">
                <option value="0" class='null'>All Categories</option>
                <?php foreach ($categories_all as $category) {
                    $selected = '';
                    if ($category['id'] == $_GET['categories_id']) {
                        $selected = 'selected';
                    }
                    ?>
                    <option <?= $selected ?> value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                <?php } ?>
            </select>
            <br>


            <label>I search in those subcategories</label>
            <br>
            <select id="subcategories" name="subcategories_id" class="custom-select">
                <option value="0" class='null'>All Subcategories</option>
                <?php
                if ($_GET['categories_id']) {
                    $this->model_search = new Model_Search();
                    $subcategories_all = $this->model_search->subcategories_all($_GET['categories_id']);
                }
                foreach ($subcategories_all as $subcategory) {
                    $selected = '';
                    if ($subcategory['id'] == $_GET['subcategories_id']) {
                        $selected = 'selected';
                    }
                    ?>
                    <option <?= $selected ?> value="<?= $subcategory['id'] ?>"><?= $subcategory['name'] ?></option>
                <?php } ?>
            </select>
            <br>


            <br>
            <button type="submit" class="btn btn-primary">Search</button>

        </div>
        <div class="col">список</div>
    </div>

</form>


<script type='text/javascript'>
    $(document).ready(function () {

        $('#countries').on('change', function () {
            $('#cities').find('option:not(.null)').remove();
            if (this.value != 0) {
                $.post(
                    '/search/ajax/',
                    {
                        'method': 'cities_all',
                        'country_id': this.value
                    },
                    function (result) {
                        console.debug(result);
                        if (result.status == true) {
                            var length = result.answer.length;
                            for (var j = 0; j < length; j++) {
                                var newOption = $('<option/>');
                                newOption.text(result.answer[j].name);
                                newOption.attr('value', result.answer[j].id);
                                $('#cities').append(newOption);
                            }
                        }
                    });
            }
        });


        $('#categories').on('change', function () {
            $('#subcategories').find('option:not(.null)').remove();
            if (this.value != 0) {
                $.post(
                    '/search/ajax/',
                    {
                        'method': 'subcategories_all',
                        'category_id': this.value
                    },
                    function (result) {
                        console.debug(result);
                        if (result.status == true) {
                            var length = result.answer.length;
                            for (var j = 0; j < length; j++) {
                                var newOption = $('<option/>');
                                newOption.text(result.answer[j].name);
                                newOption.attr('value', result.answer[j].id);
                                $('#subcategories').append(newOption);
                            }
                        }
                    });
            }
        });
    });
</script>