<template>
    <footer class="relative sky-bg" id="contact-page" style="padding-top: 15px">
        <div class="absolute footer-bg"></div>
        <div class="footer-middle">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 pull-right vcenter">
                        <ul class="social-menu text-right x-left">
                            <li><a href="#"><i class="ti-facebook"></i></a></li>
                            <li><a href="#"><i class="ti-twitter"></i></a></li>
                            <li><a href="#"><i class="ti-google"></i></a></li>
                            <li><a href="#"><i class="ti-linkedin"></i></a></li>
                            <li><a href="#"><font-awesome-icon icon="envelope" /></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <p>&copy;Copyright 2019 All right reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</template>

<script>
    export default {
        name: "FrontFooter"
    }
</script>

<style scoped>
    .footer-middle{
        margin-bottom: 20px;
    }
    .vcenter {
        display: inline-block;
        vertical-align: middle;
        float: none;
    }
</style>