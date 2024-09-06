<template>
    <h1 class="animate-beat dark:text-white text-black py-2 font-extrabold leading-tight">
        BeatLink
    </h1>
</template>
<style scoped lang="scss">

.animate-beat {
    animation: beat 1s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    animation-direction: alternate;
}

@keyframes beat {
    20%, 60% {
        opacity: .5;
    }
    40%, 80% {
        opacity: 1;
    }
}
</style>
