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
            // Envía el nuevo estado al servidor
            axios.patch(`/api/tasks/${task.id}`, { completed: task.completed })
                .then(response => {
                    // Si la respuesta es exitosa, actualiza el estado de la tarea en el componente
                    // Asegúrate de que la respuesta del servidor incluya el estado actualizado de la tarea
                    // y actualiza el componente de acuerdo a esa respuesta para mantener la sincronización
                    task.completed = response.data.completed; // Asume que response.data.completed es el estado actualizado
                })
                .catch(error => {
                    console.error('Error al actualizar la tarea:', error);
                    // No es necesario revertir el cambio aquí ya que no hemos cambiado el estado local aún
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

        }
    }
}
</script>
  