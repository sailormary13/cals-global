<form id="searchform" method="get" action="<?php echo home_url('/'); ?>">
    <input type="text" class="search-field" name="s" placeholder="Search" value="<?php the_search_query(); ?>">
    <button type="submit" class="search-submit">

        <svg width="19px" id="search-button" aria-label="Open Search" viewBox="0 0 19 18" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                <g id="Desktop-HD-Alt" sketch:type="MSArtboardGroup" transform="translate(-1242.000000, -34.000000)" fill="#FFFFFF">
                    <g id="satellite-nav" sketch:type="MSLayerGroup" transform="translate(1141.000000, 26.000000)">
                        <g id="1427843142_common_search_lookup_" transform="translate(101.000000, 8.000000)" sketch:type="MSShapeGroup">
                            <g id="miu">
                                <g id="common_search_lookup_glyph">
                                    <path d="M13.3667388,11.5346894 C14.1956945,10.3458308 14.6818182,8.90014012 14.6818182,7.34090909 C14.6818182,3.28663675 11.3951814,0 7.34090909,0 C3.28663675,0 0,3.28663675 0,7.34090909 C0,11.3951814 3.28663675,14.6818182 7.34090909,14.6818182 C8.89990029,14.6818182 10.3453862,14.195844 11.5341409,13.3671211 L11.5346339,13.3666833 L16.9786009,18.8106502 C17.0795394,18.9115888 17.2400871,18.9146947 17.3437279,18.8110538 L18.8110538,17.3437279 C18.9117694,17.2430123 18.9070875,17.0750381 18.8106502,16.9786009 L13.3667388,11.5346894 L13.3667388,11.5346894 Z M7.34090909,12.9545455 C10.441235,12.9545455 12.9545455,10.441235 12.9545455,7.34090909 C12.9545455,4.24058318 10.441235,1.72727273 7.34090909,1.72727273 C4.24058318,1.72727273 1.72727273,4.24058318 1.72727273,7.34090909 C1.72727273,10.441235 4.24058318,12.9545455 7.34090909,12.9545455 L7.34090909,12.9545455 Z" id="search-icon"></path>
                                </g>
                            </g>
                        </g>
                    </g>
                </g>
            </g>
        </svg>
    </button>
</form>