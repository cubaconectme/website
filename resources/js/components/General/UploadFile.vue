<template>
    <div class="example-drag">
        <div class="upload">
            <div v-if="files.length">
                <span v-for="(file, index) in files" :key="file.id" style="list-style: none">
                    <adorable_avatar :size="80"  :radius="50" :url="image_url"/>
                </span>
            </div>
            <ul class="draw-drop-upload" >
                <li style="list-style: none;">
                    <div class="p-5 text-center">
                        <h4>Arrastre la foto y sueltela <br/>o</h4>
                        <label for="files" class="button">Seleccione</label>
                        <input type="file"  id="files" @change="updateFiles" style="display: none;">
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>
<script>
    import FileUpload from 'vue-upload-component'
    export default {
        components: {
            FileUpload,
        },
        data() {
            return {
                files: [],
                error_image: false,
                image_url: ''
            }
        },
        methods:{
            updateFiles(event){
                this.files = [];
                let image = event.target.files[0];
                if(image.type !== 'image/jpeg' && image.type !== 'image/png') {
                    this.error_image = true;
                    return false;
                }
                this.files.push(image);
                let image_reader = new FileReader();
                image_reader.readAsDataURL(this.files[0]);
                image_reader.onload =  (e) => {
                    this.image_url =  e.target.result;
                };
                console.log(image_reader.result);
                this.image_url = image_reader.result;
            }
        },
    }
</script>
<style>
    .example-drag label.btn {
        margin-bottom: 0;
        margin-right: 1rem;
    }
    .example-drag .drop-active {
        top: 0;
        bottom: 0;
        right: 0;
        left: 0;
        position: fixed;
        z-index: 9999;
        opacity: .6;
        text-align: center;
        background: #000;
    }
    .example-drag .drop-active h3 {
        margin: -.5em 0 0;
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        -webkit-transform: translateY(-50%);
        -ms-transform: translateY(-50%);
        transform: translateY(-50%);
        font-size: 40px;
        color: #fff;
        padding: 0;
    }
    .draw-drop-upload{
        border: 2px dashed gray;
        border-radius: 5px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding-top: 15px ;
        padding-bottom: 15px ;
        margin-top: 15px;
        padding-left:0;
    }
    .button {
        border-radius: 0;
    }

    .button[disabled="disabled"], .button[disabled="true"]{
        cursor: no-drop;
        background-color: #ceced6;
    }
    .button-default{
        background: #87a6cd;
        color: #1c294e;
    }

    .button-default:hover{
        transition: 0.5s;
        background: white;
        color: #1d68a7;
    }
</style>
