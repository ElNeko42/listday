<template>
  <div class="container mx-auto p-4">
    <Header />
    
    <h1 class="mt-6 text-2xl font-bold text-gray-900 sm:text-3xl md:text-4xl mb-4">
      Mis Tareas
    </h1>

    <main class="flex flex-col space-y-4 sm:space-y-0 sm:flex-row sm:items-center sm:space-x-4">
      <InputAnimate id="stack" label="Tarea" :modelValue="stack" @update:modelValue="stack = $event" class="flex-grow" />
      
      <div class="w-full sm:w-64">
        <InputAnimate id="date" label="Fecha" :modelValue="date" @update:modelValue="date = $event" type="date" />
      </div>
      
      <Button buttonText="Add Task +"
        buttonClass="h-12 px-6 py-2 border border-green-500 bg-green-500 text-white hover:bg-transparent hover:text-green-500 focus:ring active:text-green-700 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-110"
        @click="addStack" />
    </main>
  </div>
</template>

<script>
import Header from '../../MyComponents/Header.vue';
import InputAnimate from '../../MyComponents/InputAnimate.vue';
import Button from '../../MyComponents/Button.vue';

export default {
  components: {
    Header,
    InputAnimate,
    Button,
  },
  data() {
    return {
      stack: '',
      date: '',
    };
  },
  methods: {
    addStack() {
    }
  }
};
</script>

<style>
</style>
