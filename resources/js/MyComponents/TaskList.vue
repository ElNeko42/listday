<template>
    <div class="space-y-4">
      <div class="mt-5">
        <!-- Lista de tareas -->
        <ul class="space-y-3">
          <li v-for="(task, index) in tasks" :key="index" class="flex items-center justify-between p-3 rounded shadow">
            <div class="flex items-center">
              <input type="checkbox" v-model="task.completed" @change="toggleTaskCompletion(task)" class="mr-2 h-4 w-4">
              <span :class="{'line-through': task.completed}">{{ task.name }}</span>
            </div>
            <div class="flex items-center">
              <button @click="editTask(task)" class="p-1.5 mr-2 text-blue-500 hover:bg-blue-100 rounded">
                <!-- Icono de editar -->
              </button>
              <button @click="deleteTask(task)" class="p-1.5 text-red-500 hover:bg-red-100 rounded">
                <!-- Icono de eliminar -->
              </button>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: 'TaskList',
    props: {
      tasks: Array
    },
    methods: {
      toggleTaskCompletion(task) {
        task.completed = !task.completed;
       
      },
      editTask(task) {
        
      },
      deleteTask(task) {
        
      }
    }
  }
  </script>
  