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
    },

    turnOnSwitch: async (id, credentials) => {
        try {
            const response = await fetch(`http://localhost:8080/onUser/${id}`, {
                method: 'PUT',
                headers: {
                    'Authorization': `Basic ${credentials}`,
                },
            });

            if (!response.ok) {
                throw new Error(`Error encendiendo el elemento con ID ${id}`);
            }

            const data = await response.json();
            console.log('Elemento encendido con éxito:', data);

            return data;
        } catch (error) {
            console.error('Error al encender el elemento:', error.message);
            throw error;
        }
    },

    turnOffSwitch: async (id, credentials) => {
        try {
            const response = await fetch(`http://localhost:8080/offUser/${id}`, {
                method: 'PUT',
                headers: {
                    'Authorization': `Basic ${credentials}`,
                },
            });

            if (!response.ok) {
                throw new Error(`Error al apagar el elemento con ID ${id}`);
            }

            const data = await response.json();
            console.log('Elemento apagado con éxito:', data);

            return data;
        } catch (error) {
            console.error('Error al apagar el elemento:', error.message);
            throw error;
        }
    },

    turnOnLink: async (id) => {
        try {
            const response = await fetch(`http://localhost:8080/onLink/${id}`, {
                method: 'PUT',
            });

            if (!response.ok) {
                throw new Error(`Error encendiendo el elemento con ID ${id}`);
            }

            const data = await response.json();
            console.log('Elemento encendido con éxito:', data);

            return data;
        } catch (error) {
            console.error('Error al encender el elemento:', error.message);
            throw error;
        }
    },

    turnOffLink: async (id) => {
        try {
            const response = await fetch(`http://localhost:8080/offLink/${id}`, {
                method: 'PUT',
            });

            if (!response.ok) {
                throw new Error(`Error al apagar el elemento con ID ${id}`);
            }

            const data = await response.json();
            console.log('Elemento apagado con éxito:', data);

            return data;
        } catch (error) {
            console.error('Error al apagar el elemento:', error.message);
            throw error;
        }
    },

    unsubsribe: async (id, credentials) => {
        try {
            const response = await fetch(`http://localhost:8080/subscription/${id}`, {
                method: 'DELETE',
                headers: {
                    'Authorization': `Basic ${credentials}`,
                },
            });

            if (!response.ok) {
                throw new Error(`Error al desubscribirse del elemento con ID ${id}`);
            }

            const data = await response.json();
            console.log('Te has desubscrito con exito:', data);

            return data;
        } catch (error) {
            console.error('Error al realizar la operacion:', error.message);
            throw error;
        }
    },

    subscribe: async (toggleURI, credentials) => {
    try {
        const response = await fetch(`http://localhost:8080/subscription/${toggleURI}`, {
          method: 'POST',
          headers: {
            'Authorization': `Basic ${credentials}`,
          },
        });
  
        if (!response.ok) {
          throw new Error('Error subscribing to switch');
        }

      } catch (error) {
        console.error('Error subscribing to switch:', error);
      }
    }
};

export default switchService;