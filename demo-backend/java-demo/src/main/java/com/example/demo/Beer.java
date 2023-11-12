package com.example.demo;

import javax.annotation.Generated;
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.Id;
import javax.persistence.GeneratedType;
import lombok.Data;

@Data
@Entity
public class Beer {
  @Id
  @GeneratedType(strategy=GeneratedType.IDENTITY)
  private Long id;
  private String name;
  private Double abv;
}
