<template>
    <div class="image-uploader">
        <input ref="input" type="file" multiple class="image-uploader__input" @change="uploadPhotos($event)">
        <photo :image="renderedImage"
               :new-image="file"
               @clickPhoto="openPhotoUploader"
               @removePhoto="removePhoto"
               @imageRendered="addNewImage"></photo>
    </div>
</template>

<script>
    import Photo from './photo';

    export default {
        name: 'image-uploader',

        components: {
            Photo
        },

        props: {
            startingImage: {
                type: String
            }
        },

        data: _ => ({
            file: null,
            renderedImage: null,
            image: null,
        }),

        mounted() {
          if (this.startingImage) {
            this.renderedImage = this.startingImage;
          }
        },

        methods: {
            addNewImage({ img, idx, renderedImage }) {
                this.image = img;
                this.renderedImage = renderedImage;
            },

            openPhotoUploader() {
                this.$refs.input.click();
            },

            removePhoto(idx) {
              this.image = null;
              this.renderedImage = null;
              this.file = null;
              this.$emit('removePhoto');
            },

            uploadPhotos(e) {
                var files = e.target.files || e.dataTransfer.files;
                if (!files.length) {
                    return;
                }
                this.file = files[0];
                this.$emit('photoUploaded', this.file);
            }
        },
    }
</script>

<style lang="sass">
    .image-uploader
        width: 200px
        height: 200px

        &__input
            display: none
</style>
