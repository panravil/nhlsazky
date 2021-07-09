<a href=' . $link . ' target="_blank" rel="noreferrer" class="col-sm-6 col-md-4">
    <div class="thumbnail" data-aos="fade-up" data-aos-once="true">';
    if (isset($item->enclosure)) {

        echo "<img src='" . $item->enclosure['url'] . "' class='img-responsive' alt=''>";

    } else {

        echo "<img src='/images/novinky/neexistuje.jpg' class='img-responsive' alt='$title'>";

    }
    echo '<div class="caption">
<div><span class="badge"><i class="fa fa-calendar"></i> ' . $date . '</span> </div>
<div class="post_box_nadpis">{{ $post-title }}</div>
        <p>{{ $post->text }}</p>
      </div>
    </div>
  </a>
