<template>
    <footer class="relative " id="contact-page" style="padding-top: 15px;background-color:#f2fefe;">
        <div class="absolute footer-bg"></div>
        <div class="footer-middle" >
            <div class="container">
                <div class="row text-center">
                    <h4 class="follow-us">Síguenos en</h4>
                    <div class="col-xs-12 col-sm-6 vcenter">
                        <ul class="social-menu x-left">
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
        <div class="footer-bottom sky-bg">
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
    .follow-us{
        color: #138fc2;
    }
    .footer-middle{
        background: none;
    }
    .footer-middle{
        margin-bottom: 20px;
    }
    .footer-bottom{
        padding-top: 10px;
        padding-bottom: 10px;
    }
    .vcenter {
        display: inline-block;
        vertical-align: middle;
        float: none;
    }
</style>