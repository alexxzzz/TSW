package com.iamon.iamon.service;

import org.springframework.stereotype.Service;

import com.iamon.iamon.entity.User;
import com.iamon.iamon.dto.UserDto;
import com.iamon.iamon.repository.UserRepository;

@Service
public class UserServiceImpl implements UserService{
    private UserRepository userRepository;

    public UserServiceImpl(UserRepository userRepository){
        this.userRepository = userRepository;
    }

    @Override
    public void registerUser(UserDto userDto){

        User user = new User();

        user.setUsername(userDto.getUsername());
        user.setPassword(userDto.getPassword());
        if (userDto.getEmail() != null) {
            user.setEmail(userDto.getEmail());
        } 

        userRepository.save(user);
    }
}
