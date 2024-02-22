<template>
    <div class="space-y-4">
        <div class="mt-5">
            <ul class="space-y-3">
                <li v-for="(task, index) in tasks" :key="index"
                    class="flex items-center justify-between p-3 rounded shadow">
                    <div class="flex items-center">
                        <input type="checkbox" v-model="task.completed" @change="toggleTaskCompletion(task)"
                            class="mr-2 h-4 w-4">
                        <!-- Mostrar input o span según el estado de edición -->
                        <template v-if="task.isEditing">
                            <input type="text" v-model="task.task" class="mr-2">
                        </template>
                        <template v-else>
                            <span :class="{ 'line-through': task.completed }">{{ task.task }}</span>
                        </template>
                    </div>
                    <div class="flex items-center">
                        <!-- Mostrar botones de editar o aceptar/cancelar según el estado de edición -->
                        <template v-if="task.isEditing">
                            <button @click="confirmEdit(task)"
                                class="p-1.5 mr-2 text-green-500 hover:bg-green-100 rounded">✓</button>
                            <button @click="cancelEditing(task)"
                                class="p-1.5 text-gray-500 hover:bg-gray-100 rounded">✕</button>
                        </template>
                        <template v-else>
                            <button @click="startEditing(task)" class="p-1.5 mr-2 text-blue-500 hover:bg-blue-100 rounded">
                                <i class="fas fa-pencil-alt"></i>
                            </button>
                            <button @click="deleteTask(task)" class="p-1.5 text-red-500 hover:bg-red-100 rounded">
                                <i class="fas fa-trash"></i>
                            </button>
                        </template>
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
          
            console.log('Tarea completada:', task.completed);
            axios.patch(`/api/tasks/${task.id}`, { completed: task.completed })
                .then(response => {
                   
                    task.completed = response.data.completed; 
                })
                .catch(error => {
                    console.error('Error al actualizar la tarea:', error);
                    
                });
        },
        startEditing(task) {
            task.originalTask = task.task;
            task.isEditing = true;
        },
        cancelEditing(task) {
            task.task = task.originalTask;
            task.isEditing = false;
        },
        confirmEdit(task) {
            console.log('Tarea actualizada:', task.task);
            task.isEditing = false;
            // Envía el nombre de la tarea actualizado al servidor
            axios.put(`/api/task/${task.id}`, { task: task.task })
                .then(response => {
                    console.log('Tarea actualizada:', response.data);
                })
                .catch(error => {
                    console.error('Error al actualizar la tarea:', error);
                });
        },
        deleteTask(task) {
            if (confirm('¿Estás seguro de querer eliminar esta tarea?')) {
                axios.delete(`/api/tasks/${task.id}`)
                    .then(response => {
                        // Eliminar la tarea del array de tareas en el frontend
                        const index = this.tasks.findIndex(t => t.id === task.id);
                        if (index !== -1) {
                            this.tasks.splice(index, 1);
                        }
                    })
                    .catch(error => {
                        console.error('Error al eliminar la tarea:', error);

                    });
            }
        }

    }
}
</script>
  