<template>
    <div class="photo"
         :style="'height: ' + height + 'px;'"
         @click="clickEvent">
        <div class="loading-bg" v-if="loading">
            <loader></loader>
        </div>
        <div class="photo-action-bar" v-if="image !== null">
            <button class="remove-btn" @click.stop="remove">&times;</button>
        </div>
        <div v-if="image !== null" class="image" :style="'background-image: url('  + image + ')'"></div>
        <span v-else>Add Image</span>
    </div>
</template>

<script>
    import imageLoader from 'blueimp-load-image';
    import Loader from './loader';

    export default {
        name: 'photo',

        components: {
            Loader
        },

        props: {
            image: {
                type: [ String, File ]
            },

            newImage: {
                type: File
            }
        },

        data: _ => ({
            height: 0,
            loading: false
        }),

        mounted() {
            var width = this.$el.clientWidth;

            this.height = width;
        },

        methods: {
            clickEvent() {
                this.$emit('clickPhoto');
            },

            finishRenderingImage(e) {
                var output = {
                    img: this.newImage,
                    idx: this.index,
                    renderedImage: e.toDataURL()
                };
                this.$emit('imageRendered', output);
                this.loading = false;
            },

            remove() {
                this.$emit('removePhoto');
            }
        },

        watch: {
            newImage(file) {
                if (file !== null) {
                    this.loading = true;
                    imageLoader(file,
                        this.finishRenderingImage,
                        {
                            canvas: true,
                            orientation: true,
                            maxWidth: 400
                        });
                }
            }
        }
    }
</script>

<style lang="sass" scoped>
    $border-radius: 0px

    .photo
        width:              200px
        flex:               1
        position:           relative
        background:         #fff
        border:             solid 5px var(--purple)
        border-radius:      $border-radius
        cursor:             pointer
        background-repeat:  no-repeat
        background-size:    contain
        display:            flex
        align-items:        center
        justify-content:    center

        &:last-of-type
            margin-right: 0px

        .image
            height:                 100%
            width:                  100%
            background-size:        cover
            background-repeat:      no-repeat
            background-position:    center
            border-radius:          $border-radius

        .photo-action-bar
            opacity:                    0
            position:                   absolute
            z-index:                    21
            top:                        0
            left:                       0
            display:                    flex
            width:                      100%
            padding:                    0px 5px
            padding-bottom:             3px
            background:                 #333333ee
            border-top-left-radius:     $border-radius
            border-top-right-radius:    $border-radius

            .remove-btn
                background:     none
                border:         none
                cursor:         pointer
                font-size:      25px
                padding:        0px
                line-height:    0.8
                margin-left:    auto
                color:          #fff

                &:focus
                    outline: none

            @media screen and (max-width: 956px)
                &
                    opacity: 1

        &:hover
            .photo-action-bar
                opacity: 1

    .loading-bg
        position:        absolute
        width:           100%
        height:          100%
        display:         flex
        justify-content: center
        align-items:     center
        top:             0px
        left:            0px
        background:      #33333344
        border-radius:   $border-radius

    .photo-main-banner
        position:                       absolute
        text-align:                     center
        bottom:                         0px
        width:                          100%
        font-family:                    "Roboto", sans-serif
        padding:                        5px
        background:                     #333333ee
        color:                          #fff
        border-bottom-left-radius:      $border-radius
        border-bottom-right-radius:     $border-radius
</style>
