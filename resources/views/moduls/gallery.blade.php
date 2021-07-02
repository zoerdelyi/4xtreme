<section class="team-style-one">
  <div class="auto-container">
    <!--Centered Title-->
    <div class="centered-title">
      <h2>ISMERJE MEG MUNKATÁRSAINKAT</h2>
      <div class="desc-text">Kollégáink több évtizedes tapasztalattal rendelkeznek a szakmában. Kollégáink az ügyfelek
        minél gyorsabb és szakszerűbb kiszolgálását biztosítják.</div>
    </div>
    <div class="container">
      <div class="gallery-carousel popup-gallery">
        @php
        $files = File::files(public_path('images/slider-gallery-pictrures'));
        @endphp
        @foreach($files as $file)
        <div class="gallery-item">
          <a href="/images/slider-gallery-pictrures/{{ $file->getFilename() }}" data-effect="mfp-zoom-in" title="">
            <img src="/images/slider-gallery-pictrures/{{ $file->getFilename() }}">
          </a>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</section>