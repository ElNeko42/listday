<template>
    <div class="app-container">
      <nav class="top-nav">
        <div class="logo">CheckBuddy</div>
        <button class="logout-button">LOGOUT</button>
      </nav>
  
      <header class="task-header">
        <h1 class="task-title">My Tasks</h1>
        <p class="task-subtitle">Organize the world's largest tickle fight</p>
      </header>
  
      <div class="task-actions">
        <button class="add-task-button">ADD TASK +</button>
      </div>
  
      <div class="task-list">
        <div class="task-item" v-for="(task, index) in tasks" :key="index">
          <input type="checkbox" :id="'task-' + index" v-model="task.completed">
          <label :for="'task-' + index">{{ task.name }}</label>
          <button class="delete-task-button">🗑</button>
        </div>
      </div>
  
      <footer class="task-footer">
        {{ completedTasksCount }} of {{ tasks.length }} tasks completed
      </footer>
    </div>
  </template>
  
  <script>
  import Link from '../../MyComponents/Link.vue';

  export default {
    components: {
      Link,
    },
    data() {
      return {
        tasks: [
        ],
      };
    },
    computed: {
      completedTasksCount() {
        return this.tasks.filter(task => task.completed).length;
      },
    },
  };
  </script>
  
  <style>
 
  </style>
  