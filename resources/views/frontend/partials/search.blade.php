<!-- SEARCH SECTION -->

<section style="background-color: #c4112f;" class="white-text center">
    <div class="container">
        <div class="row m-b-0">
            <div class="col s12">

                <form action="{{ route('search.index') }}" method="GET">

                <h4>Cari Aktivitas</h4>

                    <div class="searchbar">
                        <div class="input-field col s12 m2">
                            <select name="city" class="browser-default">
                                <option value="" disabled selected>Pilih Daerah</option>
                                <option value="Jakarta">Jakarta</option>
                                <option value="Surabaya">Surabaya</option>
                                <option value="Bali">Bali</option>
                            </select>
                        </div>

                        <div class="input-field col s12 m2">
                            <select name="type" class="browser-default">
                                <option value="" disabled selected>Choose Type</option>
                                <option value="apartment">Workshop</option>
                                <option value="house">Masak</option>
                                <option value="house">Outdoor</option>
                                <option value="house">Lainnya</option>
                            </select>
                        </div>

                        <div class="input-field col s12 m2">
                            <select name="purpose" class="browser-default">
                                <option value="" disabled selected>Target</option>
                                <option value="rent">Yatim Piatu</option>
                                <option value="sale">Orang Tua</option>
                                <option value="rent">ODGJ</option>
                                <option value="sale">Alam</option>
                            </select>
                        </div>

                        <div class="input-field col s12 m2">
                            <input type="date" name="start_date" id="start_date" class="custominputbox">
                            <label for="start_date">Start Date</label>
                        </div>

                        <div class="input-field col s12 m2">
                            <input type="text" name="maxprice" id="maxprice" class="custominputbox">
                            <label for="maxprice">Max Price</label>
                        </div>
                        
                        <div class="input-field col s12 m1">
                            <button class="btn btnsearch waves-effect waves-light w100" type="submit">
                                <i class="material-icons">search</i>
                            </button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</section>