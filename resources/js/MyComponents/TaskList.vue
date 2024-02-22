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
        editTask(task) {

        },
        deleteTask(task) {

        }
    }
}
</script>
  