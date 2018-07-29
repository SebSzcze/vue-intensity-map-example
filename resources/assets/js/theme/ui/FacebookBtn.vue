<template>
    <button type="button" class="text-grey hover:text-blue-dark" @click.prevent="share">
        <svg class="mx-2" width="10px" height="16px" viewBox="0 0 10 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <path d="M6.8212824,20 L6.8212824,11 L9.55369324,11 L10,7 L6.8212824,7 L6.8212824,5.052 C6.8212824,4.022 6.84759306,3 8.28688365,3 L9.74468914,3 L9.74468914,0.14 C9.74468914,0.097 8.49249659,0 7.225687,0 C4.5800039,0 2.92340674,1.657 2.92340674,4.7 L2.92340674,7 L0,7 L0,11 L2.92340674,11 L2.92340674,20 L6.8212824,20 Z" class="fill-current"></path>
            </g>
        </svg>
    </button>
</template>

<script>
    import SocialBtn from './SocialBtn';
    export default {
        name: "FacebookBtn",
        mixins: [SocialBtn]
    }
</script>
