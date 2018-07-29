<template>
    <div class="flex items-center my-4 font-semibold text-sm">
        <svg height="16px" class="mr-2" viewBox="0 0 14 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <g id="Ikony" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <path d="M7,18 C5.178,18 2,11.009 2,7 C2,4.243 4.243,2 7,2 C9.757,2 12,4.243 12,7 C12,11.009 8.822,18 7,18 M7,0 C3.134,0 0,3.134 0,7 C0,10.866 3.134,20 7,20 C10.866,20 14,10.866 14,7 C14,3.134 10.866,0 7,0 M7,8.635 C6.449,8.635 6,8.187 6,7.635 C6,7.084 6.449,6.635 7,6.635 C7.551,6.635 8,7.084 8,7.635 C8,8.187 7.551,8.635 7,8.635 M7,4.635 C5.343,4.635 4,5.979 4,7.635 C4,9.292 5.343,10.635 7,10.635 C8.657,10.635 10,9.292 10,7.635 C10,5.979 8.657,4.635 7,4.635" id="pin" class="fill-current"></path>
            </g>
        </svg>
        <span class="opacity-75" v-text="text"></span>
    </div>
</template>

<script>
    export default {
        name: "PinMarker",
        props: ['text']
    }
</script>

