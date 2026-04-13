    <div class="navbar">
        <div class="container">
            <div class="width-3 navbarLeft">
                <h1><a href="index.php"> Books </a></h1>
                <a class="button" href="book_create.php">Add Book</a>
            </div>

            <div class="width-9">
                <form class="filterContainer" id="filters">
                    <div>
                        <label for="title_filter">Title</label>
                        <input type="text" id="title_filter" name="title_filter">
                    </div>
                    <div>
                        <label for="format_filter">Formats</label>
                        <select id="format_filter" name="format_filter">
                            <option value="">All Formats</option>
                            <?php foreach ($formats as $format) { ?>
                                <option value="<?= h($format->id) ?>"><?= h($format->name) ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div>
                        <label for="publisher_filter">Publisher</label>
                        <select id="publisher_filter" name="publisher_filter">
                            <option value="">All Publishers</option>
                            <?php foreach ($publishers as $publisher) { ?>
                                <option value="<?= h($publisher->id) ?>"><?= h($publisher->name) ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div>
                        <label class="filter-label" for="sort_by">Sort:</label>
                        <div>
                            <select id="sort_by" name="sort_by">
                                <option value="title_asc">Title A–Z</option>
                                <option value="year_desc">Year (newest first)</option>
                                <option value="year_asc">Year (oldest first)</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <button type="button" id="apply_filters">Apply Filters</button>
                        <button type="button" id="clear_filters">Clear Filters</button>
                    </div>
                </form>
            </div>

        </div>
        
    </div>
