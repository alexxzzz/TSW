import React, { createContext, useContext, useState } from 'react';

const AuthContext = createContext();

export const AuthProvider = ({ children }) => {
  const [credentials, setCredentials] = useState(null);

  const setAuthCredentials = (username, password) => {
    const basicAuth = btoa(`${username}:${password}`);
    setCredentials(basicAuth);
  };

  const getAuthCredentials = () => {
    return credentials;
  };

  return (
    <AuthContext.Provider value={{ credentials, setAuthCredentials, getAuthCredentials }}>
      {children}
    </AuthContext.Provider>
  );
};

export const useAuth = () => {
  const context = useContext(AuthContext);
  if (!context) {
    throw new Error('useAuth must be used within an AuthProvider');
  }
  return context;
};
