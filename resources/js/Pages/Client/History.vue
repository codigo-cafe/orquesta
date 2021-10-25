<template>
    <app-layout :orchestra="orchestra">
        <div class="wrapper">
            <div class="page-header page-header-medium">
                <div class="page-header-image" data-parallax="true" style="background-position: top; background-image: url('/img/integrantes-h9.jpg');">
                </div>
                <div class="content-center">
                    <div class="container">
                        <h1 class="title title-ephesis">Conoce nuestra orquesta</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 ml-auto mr-auto">
                        <h3 class="title">The Castle Looks Different at Night...</h3>
                        <p>This is the paragraph where you can write more details about your product. Keep you user engaged by providing meaningful information. Remember that by this time, the user is curious, otherwise he wouldn't scroll to get here. Add a button if you want the user to see more. We are here to make life better.
                            <br> <br>
                        And now I look and look around and there’s so many Kanyes I've been trying to figure out the bed design for the master bedroom at our Hidden Hills compound... and thank you for turning my personal jean jacket into a couture piece.</p>

                        <p class="blockquote blockquote-primary">
                            “And thank you for turning my personal jean jacket into a couture piece.”
                            <br>
                            <br>
                            <small>
                                Kanye West, Producer.
                            </small>
                        </p>

                    </div>
                </div>
            </div>
        </div>

        <div class="section section-blog col-md-10 ml-auto mr-auto">
            <div class="container">
                <div class="section-story-overview">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="image-container image-left" style="background-image: url('/img/integrantes-h9.jpg')">
                                <p class="blockquote blockquote-primary">"Over the span of the satellite record, Arctic sea ice has been declining significantly, while sea ice in the Antarctichas increased very slightly"
                                    <br>
                                    <br>
                                    <small>-NOAA</small>
                                </p>
                            </div>
                            <div class="image-container image-left-bottom" style="background-image: url('/img/integrantes-h5.jpg')">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="image-container image-right" style="background-image: url('/img/integrantes-h3.jpg')">
                            </div>
                            <h3>So what does the new record for the lowest level of winter ice actually mean</h3>
                            <p>The Arctic Ocean freezes every winter and much of the sea-ice then thaws every summer, and that process will continue whatever happens with climate change. Even if the Arctic continues to be one of the fastest-warming regions of the world, it will always be plunged into bitterly cold polar dark every winter. And year-by-year, for all kinds of natural reasons, there’s huge variety of the state of the ice.
                            </p>
                            <p>
                                For a start, it does not automatically follow that a record amount of ice will melt this summer. More important for determining the size of the annual thaw is the state of the weather as the midnight sun approaches and temperatures rise. But over the more than 30 years of satellite records, scientists have observed a clear pattern of decline, decade-by-decade.
                            </p>
                            <p>The Arctic Ocean freezes every winter and much of the sea-ice then thaws every summer, and that process will continue whatever happens with climate change. Even if the Arctic continues to be one of the fastest-warming regions of the world, it will always be plunged into bitterly cold polar dark every winter. And year-by-year, for all kinds of natural reasons, there’s huge variety of the state of the ice.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 ml-auto mr-auto">
                        <h3 class="title">Rest of the Story:</h3>
                        <p>We are here to make life better. And now I look and look around and there’s so many Kanyes I've been trying to figure out the bed design for the master bedroom at our Hidden Hills compound... and thank you for turning my personal jean jacket into a couture piece. <br> I speak yell scream directly at the old guard on behalf of the future. daytime All respect prayers and love to Phife’s family Thank you for so much inspiration. </p>
                        <p> Thank you Anna for the invite thank you to the whole Vogue team And I love you like Kanye loves Kanye Pand Pand Panda I've been trying to figure out the bed design for the master bedroom at our Hidden Hills compound...The Pablo pop up was almost a pop up of influence. All respect prayers and love to Phife’s family Thank you for so much inspiration daytime I love this new Ferg album! The Life of Pablo is now available for purchase I have a dream. Thank you to everybody who made The Life of Pablo the number 1 album in the world! I'm so proud of the nr #1 song in the country. Panda! Good music 2016!</p>
                        <p> I love this new Ferg album! The Life of Pablo is now available for purchase I have a dream. Thank you to everybody who made The Life of Pablo the number 1 album in the world! I'm so proud of the nr #1 song in the country. Panda! Good music 2016!</p>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>
<script>
import AppLayout from '@/Pages/Client/Layouts/AppLayout'
export default {
    props: [
    'canLogin',
    'canRegister',
    'laravelVersion',
    'phpVersion',
    'orchestra',
    ],

    components: {
        AppLayout,
    },
};
</script>
