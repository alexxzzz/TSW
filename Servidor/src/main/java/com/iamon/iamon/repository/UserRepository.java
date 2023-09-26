package com.iamon.iamon.repository;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import com.iamon.iamon.entity.User;

@Repository
public interface UserRepository extends JpaRepository<User, String>{
    
}
