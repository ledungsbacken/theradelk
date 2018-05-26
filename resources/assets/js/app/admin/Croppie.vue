<template>
    <div>
        <!-- <button @click="bind(url)">Bind</button> -->
        <!-- Rotate angle is Number -->
        <!-- <button @click="rotate(-90)">Rotate Left</button>
        <button @click="rotate(90)">Rotate Right</button>
        <button @click="crop()">Crop Via Callback</button> -->
        <button class="btn btn-sm btn-success" @click="crop(viewport)">Crop {{ viewport.width }}x{{ viewport.height }}</button>
        <!-- <button @click="crop(sizes.tablet)">Crop {{ sizes.tablet.width }}x{{ sizes.tablet.height }}</button>
        <button @click="crop(sizes.phone)">Crop {{ sizes.phone.width }}x{{ sizes.phone.height }}</button>
        <button @click="crop(sizes.thumbnail)">Crop {{ sizes.thumbnail.width }}x{{ sizes.thumbnail.height }}</button> -->
        <!-- <button @click="cropViaEvent()">Crop Via Event</button> -->
        <!-- Note that 'ref' is important here (value can be anything). read the description about `ref` below. -->
        <vue-croppie
            ref=croppieRef
            :enableOrientation="true"
            :boundary="{ width: 1920/4, height: 1080/4 }"
            :viewport="{ width: viewport.width/4, height: viewport.height/4 }"
            :enableResize="false"
            @result="result"
            @update="update">
        </vue-croppie>

        <!-- the result -->
        <img v-bind:src="cropped" width="400px">

    </div>
</template>

<script>
export default {
    props : {
        url : {
            type : String,
        },
        viewport : {
            type : Object,
        },
    },
    data() {
        return {
            cropped: null,
            sizes : {
                desktop : {
                    width: 1920,
                    height: 1080
                },
                tablet : {
                    width: 900,
                    height: 1000
                },
                phone : {
                    width: 548,
                    height: 650
                },
                thumbnail : {
                    width: 480,
                    height: 270
                },
            }
        }
    },
    mounted() {

    },
    methods: {
        bind(url) {
            this.$refs.croppieRef.bind({
                url: url,
            });
        },
        // CALBACK USAGE
        crop(size = 'original') {
            // Here we are getting the result via callback function
            // and set the result to this.cropped which is being
            // used to display the result above.
            let options = {
                format: 'jpeg',
                size: size
            }
            this.$refs.croppieRef.result(options, (output) => {
                this.cropped = output;
            });
            options = {
                format: 'jpeg',
                size: size,
                type: 'blob'
            }
            this.$refs.croppieRef.result(options, (output) => {
                this.$emit('cropped', output);
            });
        },
        // EVENT USAGE
        cropViaEvent() {
            this.$refs.croppieRef.result(options);
        },
        result(output) {
            this.cropped = output;
        },
        update(val) {
            // console.log(val);
        },
        rotate(rotationAngle) {
            // Rotates the image
            this.$refs.croppieRef.rotate(rotationAngle);
        }
    }
}
</script>
