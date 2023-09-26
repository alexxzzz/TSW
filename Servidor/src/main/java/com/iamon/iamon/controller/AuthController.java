package com.iamon.iamon.controller;

import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RestController;

import com.iamon.iamon.dto.UserDto;
import com.iamon.iamon.service.UserService;

@RestController
public class AuthController {
    private UserService userService;

    public AuthController(UserService userService){
        this.userService = userService;
    }

    @PostMapping("/register")
    public void registerUser(@RequestBody UserDto userDto){
        userService.registerUser(userDto);
    }
}
