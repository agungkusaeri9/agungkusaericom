<footer class="footer_area mt-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="footer_top flex-column">
                    <div class="footer_logo">
                        <h4 class="text-white">Follow Me</h4>
                    </div>
                    <div class="footer_social text-white">
                        @forelse ($socmeds as $socmed)
                        <a target="_blank" href="{{ $socmed->link }}"><i class="{{ $socmed->name }}"></i></a>
                        @empty

                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        <div class="row footer_bottom justify-content-center">
            <p class="col-lg-8 col-sm-12 footer-text">
                2023 By Agung Kusaeri
            </p>
        </div>
    </div>
</footer>
