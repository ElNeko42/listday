<template>
    <div class="space-y-4">
        <div class="mt-5">

            <ul class="space-y-3">
                <li v-for="(task, index) in tasks" :key="index"
                    class="flex items-center justify-between p-3 rounded shadow">
                    <div class="flex items-center">
                        <input type="checkbox" v-model="task.completed" @change="toggleTaskCompletion(task)"
                            class="mr-2 h-4 w-4">
                        <span :class="{ 'line-through': task.completed }">{{ task.task }}</span>
                    </div>
                    <div class="flex items-center">
                        <button @click="editTask(task)" class="p-1.5 mr-2 text-blue-500 hover:bg-blue-100 rounded">
                            <i class="fas fa-pencil-alt"></i>

                        </button>
                        <button @click="deleteTask(task)" class="p-1.5 text-red-500 hover:bg-red-100 rounded">
                            <i class="fas fa-trash"></i>
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
            const originalCompletedState = task.completed;
            // Optimista UI update
            task.completed = !task.completed;

            axios.patch(`/api/tasks/${task.id}`, { completed: task.completed })
                .then(response => {
                    const updatedTask = response.data;
                    const index = this.tasks.findIndex(t => t.id === updatedTask.id);
                    if (index !== -1) {
                        // Reemplaza el objeto de la tarea con uno nuevo para forzar la actualización de la UI
                        this.tasks.splice(index, 1, Object.assign({}, this.tasks[index], updatedTask));
                    }
                })
                .catch(error => {
                    console.error('Error al actualizar la tarea:', error.response);
                    // Revertir el cambio en la interfaz de usuario si la actualización falla
                    task.completed = originalCompletedState;
                });
        },

        editTask(task) {

        },
        deleteTask(task) {

        }
    }
}
</script>
  