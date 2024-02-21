<template>
    <button
      :class="`inline-block shrink-0 rounded-md px-12 py-3 text-sm font-medium transition focus:outline-none ${buttonClass}`"
      :type="buttonType"
      @click="onClick"
    >
      {{ buttonText }}
    </button>
  </template>
  
  <script>
  export default {
    name: 'Button',
    props: {
      buttonText: {
        type: String,
        default: 'Button',
      },
      buttonType: {
        type: String,
        default: 'button', 
      },
      buttonClass: {
        type: String,
        default: 'border border-blue-600 bg-blue-600 text-white hover:bg-transparent hover:text-blue-600 focus:ring active:text-blue-500',
      },
    },
    methods: {
      onClick() {
        this.$emit('click');
      },
    },
  };
  </script>
  
  <style scoped>

  </style>
  