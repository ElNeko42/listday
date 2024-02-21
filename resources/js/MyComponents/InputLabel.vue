<template>
    <div class="col-span-6 sm:col-span-3">
      <label :for="inputId" class="block text-sm font-medium text-gray-700">
        {{ label }}
      </label>
      <input
        :type="type"
        :id="inputId"
        :name="inputId"
        :value="inputValue" 
        @input="onInput"
        class="mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm"
      />
    </div>
  </template>
  
  <script>
  export default {
    name: 'InputLabel',
    props: {
      label: String,
      inputValue: [String, Number],
      type: String,
      inputId: String,
    },
    methods: {
      onInput(event) {
      
        this.$emit('update:inputValue', event.target.value);
      }
    }
  }
  </script>
  