<template>
  <div class="container mx-auto p-4">
    <Header />

    <h1 class="mt-6 text-2xl font-bold text-gray-900 sm:mt-8 sm:text-3xl md:text-4xl mb-4">
      Mis Tareas
    </h1>

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0 sm:space-x-4 mb-6">
      <InputAnimate id="stack" label="Tarea" :modelValue="stack" @update:modelValue="stack = $event" class="flex-grow" />

      <div class="w-full sm:w-64">
        <InputAnimate id="date" label="Fecha" :modelValue="date" @update:modelValue="date = $event" type="date" />
      </div>


      <Button buttonText="Nueva tarea +"
        buttonClass="h-12 px-6 py-2 border border-green-500 bg-green-500 text-white hover:bg-transparent hover:text-green-500 focus:ring active:text-green-700 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-110"
        @click.native="addStack" />
    </div>

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0 sm:space-x-4 mb-6">
      <div class="w-full sm:w-64">
        <InputAnimate id="startDate" label="Fecha Inicio" :modelValue="startDate" @update:modelValue="startDate = $event"
          type="date" />
      </div>

      <div class="w-full sm:w-64">
        <InputAnimate id="endDate" label="Fecha Fin" :modelValue="endDate" @update:modelValue="endDate = $event"
          type="date" />
      </div>

      <Button buttonText="Buscar Tareas"
        buttonClass="h-12 px-6 py-2 border border-blue-500 bg-blue-500 text-white hover:bg-transparent hover:text-blue-500 focus:ring active:text-blue-700 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-110"
        @click="searchTasks" />
    </div>

    <div class="bg-gray-100 rounded-lg shadow-lg p-4">
      <TaskList :tasks="tasks" />
    </div>
  </div>
</template>
<script>
import axios from 'axios';
import Header from '../../MyComponents/Header.vue';
import InputAnimate from '../../MyComponents/InputAnimate.vue';
import Button from '../../MyComponents/Button.vue';
import TaskList from '../../MyComponents/TaskList.vue';

export default {
  components: {
    Header,
    InputAnimate,
    Button,
    TaskList,
  },
  data() {
    return {
      stack: '',
      date: '',
      startDate: '',
      endDate: '',
      tasks: [],
    };
  },
  mounted() {
    this.loadTasks();
  },
  methods: {
    loadTasks() {
      axios.get('/api/tasks')
        .then(response => {
          this.tasks = response.data;
        })
        .catch(error => {
          console.error('Hubo un error al cargar las tareas:', error.response);
        });
    },
    searchTasks() {
      axios.get(`/api/tasks/search?start=${this.startDate}&end=${this.endDate}`)
        .then(response => {
          this.tasks = response.data;
        })
        .catch(error => {
          console.error('Hubo un error al buscar las tareas:', error.response);
        });
    },
    addStack() {
      // Verificar que el nombre de la tarea no esté vacío
      if (this.stack.trim() === '') {
        alert('Por favor, ingresa el nombre de la tarea.');
        return;
      }

      // Formatear la fecha a YYYY-MM-DD
      let formattedDate = this.date;
      if (this.date) {
        const dateObject = new Date(this.date);
        formattedDate = dateObject.toISOString().split('T')[0];
      }

      // Crear un nuevo objeto de tarea
      const newTask = {
        name: this.stack,
        completed: false,
        date: formattedDate, // Usar la fecha formateada
      };

      // Enviar la solicitud a la API
      axios.post('/api/tasks', newTask)
        .then(response => {
          console.log('Tarea guardada:', response.data);
          this.tasks.push(newTask);
        })
        .catch(error => {
          console.error('Hubo un error al guardar la tarea:', error.response);
        });

      // Limpiar los campos
      this.stack = '';
      this.date = '';
    },
  }
};
</script>

<style></style>
