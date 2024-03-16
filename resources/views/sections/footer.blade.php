		<link rel="stylesheet" type="text/css" href="{{ asset('css/footer.css') }}">
		<footer class="footer">
{{-- 			<div class="container" style="padding-left: 15px;padding-right: 15px;margin-left: auto; margin-right: auto; width: 1170px;"> --}}
			<div class="container" id="footer">
				<div class="row">
					<div class="col-md-4">
						<h3> @lang('footer.about') </h3>
						<div class="footer-content" id="about">
							<p>
								@lang('footer.abouts')
							</p>
						</div>
					</div>
					<div class="col-md-4">
						<h3 class="flinks"> @lang('footer.LINKS') </h3>
						<div class="footer-content" id="links">
							<ul>
								<li><i class="icon ion-arrow-right-b"></i><a href="/blog">@lang('footer.Blog')</a></li>
								<li><i class="icon ion-arrow-right-b"></i><a href="/contact-us">@lang('footer.Contact')</a></li>
{{-- 								<li><i class="icon ion-arrow-right-b"></i><a href="">@lang('footer.Team')</a></li> --}}
								<li><i class="icon ion-arrow-right-b"></i><a href="/terms-of-use">@lang('footer.Terms')</a></li>
								<li><i class="icon ion-arrow-right-b"></i><a href="/policy">@lang('footer.Policy')</a></li>
							</ul>
						</div>
					</div>
				
					<div class="col-md-4">
						<h3>@lang('footer.CONTACT')</h3>
						<div class="footer-content" id="contact">
							<p> <i class="fa fa-envelope-o" aria-hidden="true"></i> @lang('footer.Email') :   <a href="mailto:Service@Qbank.com">nullstackbd@gmail.com</a> </p>

							<ul class="social">
								<li><a href="{{ $siteoption->facebook }}" class="facebook" target="__blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
								<li><a href="{{ $siteoption->twitter }}" class="twitter" target="__blank"><i class="fa fa-twitter"></i> </a></li>
								<li><a href="{{ $siteoption->googleplus }}" class="googleplus" target="__blank"><i class="fa fa-google-plus"></i></a></li>
								<li><a href="{{ $siteoption->youtube }}" class="instagram" target="__blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
							</ul>

						</div>
					</div>
				</div>
{{-- 				<p class="last-footer"> &copy @lang('footer.copyright')</p> --}}
				<p class="last-footer"> {{ $siteoption->copyright }} </p>
			</div>
		</footer>

		<link rel="stylesheet" type="text/css" href="/css/scrolltop.css">
		<div class="scroll">
			<a href="javascript:" id="return-to-top"><i class="fa fa-chevron-up" aria-hidden="true"></i></a>
		</div>
		<script type="text/javascript" src="/js/scrolltop.js"></script>