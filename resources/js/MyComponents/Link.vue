<template>
    <a
      :href="url"
      :class="`text-gray-700 underline ${linkClass}`"
      @click.prevent="handleClick"
    >
      {{ text }}
    </a>
  </template>
  
  <script>
  export default {
    name: 'Link',
    props: {
      text: {
        type: String,
        default: 'Click here',
      },
      url: {
        type: String,
        default: '#',
      },
      linkClass: {
        type: String,
        default: '',
      },
    },
    methods: {
      handleClick() {
        this.$emit('click');
      },
    },
  };
  </script>
  
  <style scoped>
  </style>
  