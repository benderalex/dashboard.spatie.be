<template>
    <tile :position="position">
        <div class="grid gap-2 items-center w-full bg-tile z-10" style="grid-template-columns: auto 1fr">

            <div>
                <div class="flex-none overflow-hidden w-10 h-10 rounded-full">
                    <img class="block w-10 h-10" src="https://thedeveloperworldisyours.com/wp-content/uploads/jenkins_logo.png" alt="jenkins" style="object-fit: cover;" />
                    <div class="absolute pin bg-accent opacity-25"></div>
                </div>
            </div>
            <div class="leading-tight min-w-0">
                <h2 class="truncate capitalize">
                    <b>Jenkins</b>
                </h2>
            </div>
        </div>

        <div>
            <ul class="align-self-center" v-for="job in jobs">
                <li>
                    <img :src="job.icon" alt="">
                    <span>{{job.name}}</span>

                </li>
            </ul>

        </div>


    </tile>
</template>

<script>
import echo from '../mixins/echo';
import Tile from './atoms/Tile';
import saveState from 'vue-save-state';



export default {
    components: {
        Tile,
    },

    mixins: [echo, saveState],

    props: ['name', 'position'],

    data() {
        return {
            jobs: [],
        };
    },

    computed: {
    },

    methods: {
        getEventHandlers() {
            return {
                'Jenkins.JobsFetched': response => {
                    this.jobs = response.jobs;
                },
            };
        },

        getSaveStateConfig() {
            return {
                cacheKey: `jenkins-jobs`,
            };
        },

    },
};
</script>
