import { useAuth } from '../context/AuthContext';

const switchService = {

    deleteItem: async (id, credentials) => {
        try {
            const response = await fetch(`http://localhost:8080/toggle/${id}`, {
                method: 'DELETE',
                headers: {
                    'Authorization': `Basic ${credentials}`,
                },
            });

            if (!response.ok) {
                throw new Error(`Error eliminando el elemento con ID ${id}`);
            }

            const data = await response.json();
            console.log('Elemento eliminado con éxito:', data);

            return data;
        } catch (error) {
            console.error('Error al eliminar el elemento:', error.message);
            throw error;
        }
    },

    addItem: async (switchData, credentials) => {
        try {
            const response = await fetch(`http://localhost:8080/toggle`, {
                method: 'POST',
                body: JSON.stringify(switchData),
                headers: {
                    'Authorization': `Basic ${credentials}`,
                    'Content-Type': 'application/json'
                },
            });

            if (!response.ok) {
                throw new Error(``);
            }

            console.log('Elemento agregado con éxito:', switchData.name);

            return {ok: true}
        } catch (error) {
            console.error('Error al agregar el elemento:', error.message);
            throw error;
        }
    }
};

export default switchService;