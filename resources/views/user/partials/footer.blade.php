<footer id="footer" data-sticky-footer="" class="bg-dark text-white">

        <div class="pb-1 text-white">

            <div class="container pt-5 border-top text-white">

                <div class="row">

                    <div class="col-12 col-md mr-5 footer-content">

                        <div class="ml-2">

                            <a href="/">
                                <img src="{{ asset('img/theme/logo.png') }}" data-src="{{ asset('img/theme/logo.png') }}" width="120px">
                            </a>

                        </div>

                        <small class="ml-2 mt-3">Subscription Box Apllication</small>

                    </div>

                    <div class="col-6 col-md">

                        <ul class="list-unstyled text-small">
                            <li><a href="https://selection.test/company" class="text-white" uk-scroll="offset:80">Company</a></li>
                            <li><a href="https://selection.test/about" class="text-white" uk-scroll="offset:80">About</a></li>
                            <li><a href="https://selection.test/faq" class="text-white" uk-scroll="offset:80">FAQ</a></li>
                            <li><a href="https://selection.test/vendors" class="text-white" uk-scroll="offset:80">New Vendors</a></li>
                            <li><a href="https://selection.test/sitemap" class="text-white" uk-scroll="offset:80">Sitemap</a></li>
                        </ul>

                    </div>

                    <div class="col-6 col-md">

                        <ul class="list-unstyled text-small">
                            <li><a href="https://devdojo.com/scripts/php/wave" class="text-white" target="_blank">Product Page</a></li>
                            <li><a href="/docs" class="text-white">Documentation</a></li>
                            <li><a href="https://devdojo.com/series/wave" class="text-white" target="_blank">Videos</a></li>
                        </ul>

                    </div>

                    <div class="col-12 col-md">

                        <div class="text-white">contact@app.com</div>

                        <div class="text-white">
                            <p>Sign up for exclusive deals, updates and free stuff.</p>

                            <div class="float-right">
                                <div class="uk-child-width-auto uk-grid-medium uk-grid" uk-grid="">
                                    <a uk-icon="icon: youtube; ratio: 0.8" href="https://www.youtube.com/devdojo" target="_blank" class="el-link uk-link-muted uk-icon"></a>
                                    <a uk-icon="icon: instagram; ratio: 0.8" href="https://www.instagram.com/devdojo" target="_blank" class="el-link uk-link-muted uk-icon"></a>
                                    <a uk-icon="icon: twitter; ratio: 0.8" href="https://twitter.com/thedevdojo" target="_blank" class="el-link uk-link-muted uk-icon"></a>
                                    <a uk-icon="icon: facebook; ratio: 0.8" href="https://www.facebook.com/thedevdojo" target="_blank" class="el-link uk-link-muted uk-icon"></a>
                                </div>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Email Address" aria-label="Email Address" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-warning" type="submit">Submit</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 text-center">
                        <h5 class="text-white">&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.</h5>
                    </div>
                </div>
            </div>
        </div>
    </footer>
