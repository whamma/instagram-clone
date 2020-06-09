<template>
    <div class="pr-5">
        <strong>{{ followerCount }}</strong> followers
    </div>
</template>

<script>
import { EventBus } from '../utils/event-bus';

export default {
    name: 'follower-count',

    props: ['count'],

    data() {
        return {
            followerCount: this.count || 0,
        };
    },

    created() {
        EventBus.$on('follow', follow => {
            if (follow === 'follow') {
                this.followerCount++;
            } else {
                this.followerCount--;
            }
        });
    },
};
</script>
