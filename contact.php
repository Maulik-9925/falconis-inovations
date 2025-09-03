<?php include('header.php')?>

<section class="page-header">
    <div class="page-header__bg"></div>
    <div class="container">
        <h2 class="page-header__title">Contact Us</h2>
        <ul class="nionx-breadcrumb list-unstyled">
            <li><a href="index.html">Home</a></li>
            <li><span>Contact Us</span></li>
        </ul>
    </div>
</section>

        <section class="contact-one">
            <div class="container">
                <div class="contact-one__inner">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="contact-one__content  wow fadeInUp" data-wow-duration="1000ms">
                                <div class="contact-one__content__head">
                                    <div class="sec-title wow fadeInUp" data-wow-duration='300ms'>
                                        <h6 class="sec-title__tagline">Contact Us</h6><!-- /.sec-title__tagline -->
                                        <h3 class="sec-title__title">Feel Free to Write us Anytime</h3><!-- /.sec-title__title -->
                                    </div><!-- /.sec-title -->
                                    <p class="contact-one__text">There are many variations of passages of Lorem Ipsum available, but the majority </p><!-- /.contact-one__text -->
                                </div><!-- /.contact-one__content__head -->
                                <ul class="list-unstyled contact-one__info">
                                    <li class="contact-one__info__item">
                                        <div class="contact-one__info__icon">
                                            <i class="icon-phone-1"></i>
                                        </div><!-- /.contact-one__info__icon -->
                                        <div class="contact-one__info__content">
                                            <p class="contact-one__info__text">Have any question?</p>
                                            <!-- /.contact-one__info__text -->
                                            <h4 class="contact-one__info__title"><a href="tel:+92(8800)-8960">Free + 23 (000)-8050</a></h4><!-- /.contact-one__info__title -->
                                        </div><!-- /.contact-one__info__content -->
                                    </li>
                                    <li class="contact-one__info__item">
                                        <div class="contact-one__info__icon">
                                            <i class="icon-envelope"></i>
                                        </div><!-- /.contact-one__info__icon -->
                                        <div class="contact-one__info__content">
                                            <p class="contact-one__info__text">Send Email</p>
                                            <!-- /.contact-one__info__text -->
                                            <h4 class="contact-one__info__title"><a href="mailto:needhelp@company.com">demo@gmail.com</a></h4>
                                            <!-- /.contact-one__info__title -->
                                        </div><!-- /.contact-one__info__content -->
                                    </li>
                                    <li class="contact-one__info__item">
                                        <div class="contact-one__info__icon">
                                            <i class="icon-map-pin"></i>
                                        </div><!-- /.contact-one__info__icon -->
                                        <div class="contact-one__info__content">
                                            <p class="contact-one__info__text">Visit Anytime</p> <!-- /.contact-one__info__text -->
                                            <h4 class="contact-one__info__title"><a href="#">86391 Elgin St. Delaware</a></h4><!-- /.contact-one__info__title -->
                                        </div><!-- /.contact-one__info__content -->
                                    </li>
                                </ul><!-- /.list-unstyled -->
                            </div><!-- /.contact-one__content -->
                        </div><!-- /.col-xl-7 -->
                        <div class="col-lg-8">
                            <form class="contact-one__form contact-form-validated form-one background-base wow fadeInUp" data-wow-duration="1500ms" action="https://bracketweb.com/nionx-html/inc/sendemail.php">
                                <div class="form-one__group">
                                    <div class="form-one__control">
                                        <input type="text" name="name" placeholder="Your Name">
                                    </div><!-- /.form-one__control form-one__control__full -->
                                    <div class="form-one__control">
                                        <input type="email" name="email" placeholder="Email Address">
                                    </div><!-- /.form-one__control form-one__control__full -->
                                    <div class="form-one__control">
                                        <input type="tel" name="form_phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="Phone" required="">
                                    </div><!-- /.form-one__control form-one__control__full -->
                                    <div class="form-one__control">
                                        <input type="text" name="subject" placeholder="Subject">
                                    </div><!-- /.form-one__control form-one__control__full -->
                                    <div class="form-one__control form-one__control--full">
                                        <textarea name="message" placeholder="Write a Message"></textarea><!-- /# -->
                                    </div><!-- /.form-one__control -->
                                    <div class="form-one__control form-one__control--full">
                                        <button type="submit" class="nionx-btn nionx-btn--base">Send Message</button>
                                    </div><!-- /.form-one__control -->
                                </div><!-- /.form-one__group -->
                            </form>
                        </div><!-- /.col-xl-5 -->
                    </div><!-- /.row -->
                </div><!-- /.contact-one__inner -->
            </div><!-- /.container -->
        </section><!-- /.contact-one -->


        <div class="contact-map  wow fadeInUp" data-wow-duration="1500ms">
            <div class="container-fluid">
                <div class="google-map google-map__contact">
                    <iframe title="template google map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4562.753041141002!2d-118.80123790098536!3d34.152323469614075!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80e82469c2162619%3A0xba03efb7998eef6d!2sCostco+Wholesale!5e0!3m2!1sbn!2sbd!4v1562518641290!5m2!1sbn!2sbd" class="map__contact" allowfullscreen></iframe>
                </div>
                <!-- /.google-map -->
            </div><!-- /.container-fluid -->
        </div><!-- /.contact-map -->

<?php include('footer.php')?>