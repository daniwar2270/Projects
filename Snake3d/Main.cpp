#include <memory>
#include <iostream>


#pragma comment(lib, "glfw3.lib")

// GLAD
#include <glad/glad.h>

// GLFW
#include <GLFW/glfw3.h>

// GLM
#include <glm/glm.hpp>
#include <glm/gtc/matrix_transform.hpp>
#include <glm/gtc/type_ptr.hpp>

#include "ShaderProgram.hpp"

#define STB_IMAGE_IMPLEMENTATION
#include "stb_image.h"
#include <vector>;
#include <stdio.h>
#include <stdlib.h>
#include<time.h>



const GLuint WIDTH = 800, HEIGHT = 800;
int lastpressedKey;
int gameSpeed = 7;
//glm::vec3 snakeHeadOldPos;

//glm::vec3 pos=;

//000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000



//000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000







glm::vec3 KeyboardMoveController(GLFWwindow* Window)
{

	glm::vec3 result;

	if (lastpressedKey == 1)result.x += -2.5;
	else if (lastpressedKey == 2)result.x += 2.5;
	else if (lastpressedKey == 3)result.y += -2.5;
	else if (lastpressedKey == 4)result.y += 2.5;

	return result;



};

//Vertex Constructor ///////////////////////////////////////////////////////////////////////////////
struct Vertex
{
	float x, y, z;

	float s, t;
	Vertex(float x, float y, float z, float s, float t)
		:x(x), y(y), z(z), s(s), t(t) {}
};
//Drawable Class ///////////////////////////////////////////////////////////////////////////////
class Drawable
{
protected:

	unsigned m_vao;

public:

	Drawable()
	{
		m_vao = 0;
	}
	~Drawable()
	{
		glDeleteVertexArrays(1, &m_vao);
	}
	virtual void CreateVAO() = 0;
	virtual void Draw(ShaderProgram& shader) = 0;
};
//--------------------------------------------------------------------------------------------------------


class Tail : public Drawable
{
private:
	glm::vec3 p;
	std::vector<Vertex> vertices;
	std::vector<Tail> taillist;






public:

	Tail(const glm::vec3& pos) :
		Drawable(),

		p(pos)
	{



		vertices.push_back(Vertex(-0.5f, -0.5f, -0.5f, 0.0f, 0.0f));
		vertices.push_back(Vertex(0.5f, -0.5f, -0.5f, 1.0f, 0.0f));
		vertices.push_back(Vertex(0.5f, 0.5f, -0.5f, 1.0f, 1.0f));
		vertices.push_back(Vertex(0.5f, 0.5f, -0.5f, 1.0f, 1.0f));
		vertices.push_back(Vertex(-0.5f, 0.5f, -0.5f, 0.0f, 1.0f));
		vertices.push_back(Vertex(-0.5f, -0.5f, -0.5f, 0.0f, 0.0f));

		vertices.push_back(Vertex(-0.5f, -0.5f, 0.5f, 0.0f, 0.0f));
		vertices.push_back(Vertex(0.5f, -0.5f, 0.5f, 1.0f, 0.0f));
		vertices.push_back(Vertex(0.5f, 0.5f, 0.5f, 1.0f, 1.0f));
		vertices.push_back(Vertex(0.5f, 0.5f, 0.5f, 1.0f, 1.0f));
		vertices.push_back(Vertex(-0.5f, 0.5f, 0.5f, 0.0f, 1.0f));
		vertices.push_back(Vertex(-0.5f, -0.5f, 0.5f, 0.0f, 0.0f));

		vertices.push_back(Vertex(-0.5f, 0.5f, 0.5f, 0.0f, 0.0f));
		vertices.push_back(Vertex(-0.5f, 0.5f, -0.5f, 1.0f, 0.0f));
		vertices.push_back(Vertex(-0.5f, -0.5f, -0.5f, 1.0f, 1.0f));
		vertices.push_back(Vertex(-0.5f, -0.5f, -0.5f, 1.0f, 1.0f));
		vertices.push_back(Vertex(-0.5f, -0.5f, 0.5f, 0.0f, 1.0f));
		vertices.push_back(Vertex(-0.5f, 0.5f, 0.5f, 0.0f, 0.0f));

		vertices.push_back(Vertex(0.5f, 0.5f, 0.5f, 0.0f, 0.0f));
		vertices.push_back(Vertex(0.5f, 0.5f, -0.5f, 1.0f, 0.0f));
		vertices.push_back(Vertex(0.5f, -0.5f, -0.5f, 1.0f, 1.0f));
		vertices.push_back(Vertex(0.5f, -0.5f, -0.5f, 1.0f, 1.0f));
		vertices.push_back(Vertex(0.5f, -0.5f, 0.5f, 0.0f, 1.0f));
		vertices.push_back(Vertex(0.5f, 0.5f, 0.5f, 0.0f, 0.0f));

		vertices.push_back(Vertex(-0.5f, -0.5f, -0.5f, 0.0f, 0.0f));
		vertices.push_back(Vertex(0.5f, -0.5f, -0.5f, 1.0f, 0.0f));
		vertices.push_back(Vertex(0.5f, -0.5f, 0.5f, 1.0f, 1.0f));
		vertices.push_back(Vertex(0.5f, -0.5f, 0.5f, 1.0f, 1.0f));
		vertices.push_back(Vertex(-0.5f, -0.5f, 0.5f, 0.0f, 1.0f));
		vertices.push_back(Vertex(-0.5f, -0.5f, -0.5f, 0.0f, 0.0f));

		vertices.push_back(Vertex(-0.5f, 0.5f, -0.5f, 0.0f, 0.0f));
		vertices.push_back(Vertex(0.5f, 0.5f, -0.5f, 1.0f, 0.0f));
		vertices.push_back(Vertex(0.5f, 0.5f, 0.5f, 1.0f, 1.0f));
		vertices.push_back(Vertex(0.5f, 0.5f, 0.5f, 1.0f, 1.0f));
		vertices.push_back(Vertex(-0.5f, 0.5f, 0.5f, 0.0f, 1.0f));
		vertices.push_back(Vertex(-0.5f, 0.5f, -0.5f, 0.0f, 0.0f));


	}

	glm::vec3& Position() { return p; }
	void SetPosition(glm::vec3& ps) { p = ps; };


	float getX() const { return p.x; }
	float getY() const { return p.y; }

	float XMax() const { return p.x + 0.125f; }
	float XMin() const { return p.x - 0.125f; }
	float YMax() const { return p.y + 0.125f; }
	float YMin() const { return p.y - 0.125f; }
	float ZMax() const { return p.z; }
	float ZMin() const { return p.z; }



	void Animate(GLFWwindow* Window, float d)
	{
		//float x=0.005;

		p += d * KeyboardMoveController(Window);
	}

	/*void AddTailPartPos(int x, int y) {
		bodyParts.emplace_back(glm::vec3(x,y,-0.5f));
	}

	void setLastbodyPartsPos(int x, int y) {
		lastBodyParts.emplace_back(glm::vec3(x, y, -0.5f));
	}
	*/



	virtual void CreateVAO()
	{
		glGenVertexArrays(1, &m_vao);
		glBindVertexArray(m_vao);

		unsigned int vbo;
		glGenBuffers(1, &vbo);
		glBindBuffer(GL_ARRAY_BUFFER, vbo);
		glBufferData(GL_ARRAY_BUFFER, vertices.size() * sizeof(Vertex), vertices.data(), GL_STATIC_DRAW);

		glVertexAttribPointer(0, 3, GL_FLOAT, GL_FALSE, sizeof(Vertex), NULL);

		glVertexAttribPointer(1, 2, GL_FLOAT, GL_FALSE, sizeof(Vertex), (void*)offsetof(Vertex, s));
		glEnableVertexAttribArray(0);

		glEnableVertexAttribArray(1);
		{
			int width, height, nrChannels;
			std::shared_ptr<unsigned char> pData = std::shared_ptr<unsigned char>(stbi_load("Resources/snakeTexture.jpg", &width, &height, &nrChannels, 0), stbi_image_free);
			if (!pData)
				throw std::exception("Failed to load texture");

			unsigned texture;
			glGenTextures(1, &texture);
			glActiveTexture(GL_TEXTURE1);
			glBindTexture(GL_TEXTURE_2D, texture);

			glTexParameteri(GL_TEXTURE_2D, GL_TEXTURE_WRAP_S, GL_REPEAT);
			glTexParameteri(GL_TEXTURE_2D, GL_TEXTURE_WRAP_T, GL_REPEAT);
			glTexParameteri(GL_TEXTURE_2D, GL_TEXTURE_MIN_FILTER, GL_LINEAR);
			glTexParameteri(GL_TEXTURE_2D, GL_TEXTURE_MAG_FILTER, GL_LINEAR);

			glTexImage2D(GL_TEXTURE_2D, 0, GL_RGB, width, height, 0, GL_RGB, GL_UNSIGNED_BYTE, pData.get());
			glGenerateMipmap(GL_TEXTURE_2D);
		}


	}
	virtual void Draw(ShaderProgram& shader)
	{
		glUniform1i(glGetUniformLocation(shader.ID, "ourTexture"), 1);
		glBindVertexArray(m_vao);
		glm::mat4 model = glm::mat4(1.0f);
		model = glm::translate(model, p);
		model = glm::scale(model, glm::vec3(0.25, 0.25, 0.25));




		glUniformMatrix4fv(glGetUniformLocation(shader.ID, "model"), 1, GL_FALSE, glm::value_ptr(model));
		glDrawArrays(GL_TRIANGLES, 0, vertices.size());
		glBindVertexArray(0);

	}
};
//--------------------------------------------------------------------------------------------------------
class Snake : public Drawable
{
private:
	glm::vec3 p;
	std::vector<Vertex> vertices;
	glm::vec3 oldpos;




	//std::vector<unique_ptr<Snake>> tailList;
public:
	Snake(const glm::vec3& pos) :
		Drawable(),

		p(pos)
	{



		vertices.push_back(Vertex(-0.5f, -0.5f, -0.5f, 0.0f, 0.0f));
		vertices.push_back(Vertex(0.5f, -0.5f, -0.5f, 1.0f, 0.0f));
		vertices.push_back(Vertex(0.5f, 0.5f, -0.5f, 1.0f, 1.0f));
		vertices.push_back(Vertex(0.5f, 0.5f, -0.5f, 1.0f, 1.0f));
		vertices.push_back(Vertex(-0.5f, 0.5f, -0.5f, 0.0f, 1.0f));
		vertices.push_back(Vertex(-0.5f, -0.5f, -0.5f, 0.0f, 0.0f));

		vertices.push_back(Vertex(-0.5f, -0.5f, 0.5f, 0.0f, 0.0f));
		vertices.push_back(Vertex(0.5f, -0.5f, 0.5f, 1.0f, 0.0f));
		vertices.push_back(Vertex(0.5f, 0.5f, 0.5f, 1.0f, 1.0f));
		vertices.push_back(Vertex(0.5f, 0.5f, 0.5f, 1.0f, 1.0f));
		vertices.push_back(Vertex(-0.5f, 0.5f, 0.5f, 0.0f, 1.0f));
		vertices.push_back(Vertex(-0.5f, -0.5f, 0.5f, 0.0f, 0.0f));

		vertices.push_back(Vertex(-0.5f, 0.5f, 0.5f, 0.0f, 0.0f));
		vertices.push_back(Vertex(-0.5f, 0.5f, -0.5f, 1.0f, 0.0f));
		vertices.push_back(Vertex(-0.5f, -0.5f, -0.5f, 1.0f, 1.0f));
		vertices.push_back(Vertex(-0.5f, -0.5f, -0.5f, 1.0f, 1.0f));
		vertices.push_back(Vertex(-0.5f, -0.5f, 0.5f, 0.0f, 1.0f));
		vertices.push_back(Vertex(-0.5f, 0.5f, 0.5f, 0.0f, 0.0f));

		vertices.push_back(Vertex(0.5f, 0.5f, 0.5f, 0.0f, 0.0f));
		vertices.push_back(Vertex(0.5f, 0.5f, -0.5f, 1.0f, 0.0f));
		vertices.push_back(Vertex(0.5f, -0.5f, -0.5f, 1.0f, 1.0f));
		vertices.push_back(Vertex(0.5f, -0.5f, -0.5f, 1.0f, 1.0f));
		vertices.push_back(Vertex(0.5f, -0.5f, 0.5f, 0.0f, 1.0f));
		vertices.push_back(Vertex(0.5f, 0.5f, 0.5f, 0.0f, 0.0f));

		vertices.push_back(Vertex(-0.5f, -0.5f, -0.5f, 0.0f, 0.0f));
		vertices.push_back(Vertex(0.5f, -0.5f, -0.5f, 1.0f, 0.0f));
		vertices.push_back(Vertex(0.5f, -0.5f, 0.5f, 1.0f, 1.0f));
		vertices.push_back(Vertex(0.5f, -0.5f, 0.5f, 1.0f, 1.0f));
		vertices.push_back(Vertex(-0.5f, -0.5f, 0.5f, 0.0f, 1.0f));
		vertices.push_back(Vertex(-0.5f, -0.5f, -0.5f, 0.0f, 0.0f));

		vertices.push_back(Vertex(-0.5f, 0.5f, -0.5f, 0.0f, 0.0f));
		vertices.push_back(Vertex(0.5f, 0.5f, -0.5f, 1.0f, 0.0f));
		vertices.push_back(Vertex(0.5f, 0.5f, 0.5f, 1.0f, 1.0f));
		vertices.push_back(Vertex(0.5f, 0.5f, 0.5f, 1.0f, 1.0f));
		vertices.push_back(Vertex(-0.5f, 0.5f, 0.5f, 0.0f, 1.0f));
		vertices.push_back(Vertex(-0.5f, 0.5f, -0.5f, 0.0f, 0.0f));


	}

	glm::vec3& Position() { return p; }
	glm::vec3& getOldPosition() { return oldpos; }

	void SetPosition(glm::vec3& ps) { p = ps; };
	void SetOldPosition(glm::vec3& oldps) { oldpos = oldps; };

	float getX() const { return p.x; }
	float getY() const { return p.y; }

	float XMax() const { return p.x + 0.125f; }
	float XMin() const { return p.x - 0.125f; }
	float YMax() const { return p.y + 0.125f; }
	float YMin() const { return p.y - 0.125f; }
	float ZMax() const { return p.z; }
	float ZMin() const { return p.z; }



	void Animate(GLFWwindow* Window, float d)
	{
		//float x=0.005;

		p += d * KeyboardMoveController(Window);
	}



	virtual void CreateVAO()
	{
		glGenVertexArrays(1, &m_vao);
		glBindVertexArray(m_vao);

		unsigned int vbo;
		glGenBuffers(1, &vbo);
		glBindBuffer(GL_ARRAY_BUFFER, vbo);
		glBufferData(GL_ARRAY_BUFFER, vertices.size() * sizeof(Vertex), vertices.data(), GL_STATIC_DRAW);

		glVertexAttribPointer(0, 3, GL_FLOAT, GL_FALSE, sizeof(Vertex), NULL);

		glVertexAttribPointer(1, 2, GL_FLOAT, GL_FALSE, sizeof(Vertex), (void*)offsetof(Vertex, s));
		glEnableVertexAttribArray(0);

		glEnableVertexAttribArray(1);
		{
			int width, height, nrChannels;
			std::shared_ptr<unsigned char> pData = std::shared_ptr<unsigned char>(stbi_load("Resources/snakeTexture.jpg", &width, &height, &nrChannels, 0), stbi_image_free);
			if (!pData)
				throw std::exception("Failed to load texture");

			unsigned texture;
			glGenTextures(1, &texture);
			glActiveTexture(GL_TEXTURE1);
			glBindTexture(GL_TEXTURE_2D, texture);

			glTexParameteri(GL_TEXTURE_2D, GL_TEXTURE_WRAP_S, GL_REPEAT);
			glTexParameteri(GL_TEXTURE_2D, GL_TEXTURE_WRAP_T, GL_REPEAT);
			glTexParameteri(GL_TEXTURE_2D, GL_TEXTURE_MIN_FILTER, GL_LINEAR);
			glTexParameteri(GL_TEXTURE_2D, GL_TEXTURE_MAG_FILTER, GL_LINEAR);

			glTexImage2D(GL_TEXTURE_2D, 0, GL_RGB, width, height, 0, GL_RGB, GL_UNSIGNED_BYTE, pData.get());
			glGenerateMipmap(GL_TEXTURE_2D);
		}


	}
	virtual void Draw(ShaderProgram& shader)
	{
		glUniform1i(glGetUniformLocation(shader.ID, "ourTexture"), 1);
		glBindVertexArray(m_vao);
		glm::mat4 model = glm::mat4(1.0f);
		model = glm::translate(model, p);
		model = glm::scale(model, glm::vec3(0.25, 0.25, 0.25));




		glUniformMatrix4fv(glGetUniformLocation(shader.ID, "model"), 1, GL_FALSE, glm::value_ptr(model));
		glDrawArrays(GL_TRIANGLES, 0, vertices.size());
		glBindVertexArray(0);

	}
};

//-----------------------------------------------------------------------------------------------------------






//--------------------------------------------------------------------------------------------------

class Food : public Drawable
{

private:
	glm::vec3 p;
	std::vector<Vertex> vertices;

public:
	Food(const glm::vec3& pos) :
		Drawable(),

		p(pos)
	{



		vertices.push_back(Vertex(-0.5f, -0.5f, -0.5f, 0.0f, 0.0f));
		vertices.push_back(Vertex(0.5f, -0.5f, -0.5f, 1.0f, 0.0f));
		vertices.push_back(Vertex(0.5f, 0.5f, -0.5f, 1.0f, 1.0f));
		vertices.push_back(Vertex(0.5f, 0.5f, -0.5f, 1.0f, 1.0f));
		vertices.push_back(Vertex(-0.5f, 0.5f, -0.5f, 0.0f, 1.0f));
		vertices.push_back(Vertex(-0.5f, -0.5f, -0.5f, 0.0f, 0.0f));

		vertices.push_back(Vertex(-0.5f, -0.5f, 0.5f, 0.0f, 0.0f));
		vertices.push_back(Vertex(0.5f, -0.5f, 0.5f, 1.0f, 0.0f));
		vertices.push_back(Vertex(0.5f, 0.5f, 0.5f, 1.0f, 1.0f));
		vertices.push_back(Vertex(0.5f, 0.5f, 0.5f, 1.0f, 1.0f));
		vertices.push_back(Vertex(-0.5f, 0.5f, 0.5f, 0.0f, 1.0f));
		vertices.push_back(Vertex(-0.5f, -0.5f, 0.5f, 0.0f, 0.0f));

		vertices.push_back(Vertex(-0.5f, 0.5f, 0.5f, 0.0f, 0.0f));
		vertices.push_back(Vertex(-0.5f, 0.5f, -0.5f, 1.0f, 0.0f));
		vertices.push_back(Vertex(-0.5f, -0.5f, -0.5f, 1.0f, 1.0f));
		vertices.push_back(Vertex(-0.5f, -0.5f, -0.5f, 1.0f, 1.0f));
		vertices.push_back(Vertex(-0.5f, -0.5f, 0.5f, 0.0f, 1.0f));
		vertices.push_back(Vertex(-0.5f, 0.5f, 0.5f, 0.0f, 0.0f));

		vertices.push_back(Vertex(0.5f, 0.5f, 0.5f, 0.0f, 0.0f));
		vertices.push_back(Vertex(0.5f, 0.5f, -0.5f, 1.0f, 0.0f));
		vertices.push_back(Vertex(0.5f, -0.5f, -0.5f, 1.0f, 1.0f));
		vertices.push_back(Vertex(0.5f, -0.5f, -0.5f, 1.0f, 1.0f));
		vertices.push_back(Vertex(0.5f, -0.5f, 0.5f, 0.0f, 1.0f));
		vertices.push_back(Vertex(0.5f, 0.5f, 0.5f, 0.0f, 0.0f));

		vertices.push_back(Vertex(-0.5f, -0.5f, -0.5f, 0.0f, 0.0f));
		vertices.push_back(Vertex(0.5f, -0.5f, -0.5f, 1.0f, 0.0f));
		vertices.push_back(Vertex(0.5f, -0.5f, 0.5f, 1.0f, 1.0f));
		vertices.push_back(Vertex(0.5f, -0.5f, 0.5f, 1.0f, 1.0f));
		vertices.push_back(Vertex(-0.5f, -0.5f, 0.5f, 0.0f, 1.0f));
		vertices.push_back(Vertex(-0.5f, -0.5f, -0.5f, 0.0f, 0.0f));

		vertices.push_back(Vertex(-0.5f, 0.5f, -0.5f, 0.0f, 0.0f));
		vertices.push_back(Vertex(0.5f, 0.5f, -0.5f, 1.0f, 0.0f));
		vertices.push_back(Vertex(0.5f, 0.5f, 0.5f, 1.0f, 1.0f));
		vertices.push_back(Vertex(0.5f, 0.5f, 0.5f, 1.0f, 1.0f));
		vertices.push_back(Vertex(-0.5f, 0.5f, 0.5f, 0.0f, 1.0f));
		vertices.push_back(Vertex(-0.5f, 0.5f, -0.5f, 0.0f, 0.0f));


	}

	glm::vec3& Position() { return p; }
	void SetPosition(glm::vec3& ps) { p = ps; };
	float XMax() const { return p.x + 0.125f; }
	float XMin() const { return p.x - 0.125f; }
	float YMax() const { return p.y + 0.125f; }
	float YMin() const { return p.y - 0.125f; }
	float ZMax() const { return p.z; }
	float ZMin() const { return p.z; }






	virtual void CreateVAO()
	{
		glGenVertexArrays(1, &m_vao);
		glBindVertexArray(m_vao);

		unsigned int vbo;
		glGenBuffers(1, &vbo);
		glBindBuffer(GL_ARRAY_BUFFER, vbo);
		glBufferData(GL_ARRAY_BUFFER, vertices.size() * sizeof(Vertex), vertices.data(), GL_STATIC_DRAW);

		glVertexAttribPointer(0, 3, GL_FLOAT, GL_FALSE, sizeof(Vertex), NULL);

		glVertexAttribPointer(1, 2, GL_FLOAT, GL_FALSE, sizeof(Vertex), (void*)offsetof(Vertex, s));
		glEnableVertexAttribArray(0);

		glEnableVertexAttribArray(1);
		{
			int width, height, nrChannels;
			std::shared_ptr<unsigned char> pData = std::shared_ptr<unsigned char>(stbi_load("Resources/food.jpg", &width, &height, &nrChannels, 0), stbi_image_free);
			if (!pData)
				throw std::exception("Failed to load texture");

			unsigned texture;
			glGenTextures(1, &texture);
			glActiveTexture(GL_TEXTURE2);
			glBindTexture(GL_TEXTURE_2D, texture);

			glTexParameteri(GL_TEXTURE_2D, GL_TEXTURE_WRAP_S, GL_REPEAT);
			glTexParameteri(GL_TEXTURE_2D, GL_TEXTURE_WRAP_T, GL_REPEAT);
			glTexParameteri(GL_TEXTURE_2D, GL_TEXTURE_MIN_FILTER, GL_LINEAR);
			glTexParameteri(GL_TEXTURE_2D, GL_TEXTURE_MAG_FILTER, GL_LINEAR);

			glTexImage2D(GL_TEXTURE_2D, 0, GL_RGB, width, height, 0, GL_RGB, GL_UNSIGNED_BYTE, pData.get());
			glGenerateMipmap(GL_TEXTURE_2D);
		}


	}
	virtual void Draw(ShaderProgram& shader)
	{
		glUniform1i(glGetUniformLocation(shader.ID, "ourTexture"), 2);
		glBindVertexArray(m_vao);
		glm::mat4 model = glm::mat4(1.0f);
		model = glm::translate(model, p);
		model = glm::scale(model, glm::vec3(0.25, 0.25, 0.25));




		glUniformMatrix4fv(glGetUniformLocation(shader.ID, "model"), 1, GL_FALSE, glm::value_ptr(model));
		glDrawArrays(GL_TRIANGLES, 0, vertices.size());
		glBindVertexArray(0);

	}
};

//----------------------------------------------------------------------------------------------------------
class Map : public Drawable
{
private:
	glm::vec3 p;
	std::vector<Vertex> vertices;

public:
	Map(const glm::vec3& pos) :
		Drawable(),

		p(pos)
	{



		vertices.push_back(Vertex(-1.0f, -1.0f, 0.0f, 0.0f, 0.0f));
		vertices.push_back(Vertex(1.0f, -1.0f, 0.0f, 1.0f, 0.0f));
		vertices.push_back(Vertex(-1.0f, 1.0f, 0.0f, 0.0f, 1.0f));
		vertices.push_back(Vertex(1.0f, 1.0f, 0.0f, 1.0f, 1.0f));


	}

	glm::vec3& Position() { return p; }
	void SetPosition(glm::vec3& ps) { p = ps; };




	float XMax() const { return p.x + 1.875f; }
	float XMin() const { return p.x - 1.875f; }
	float YMax() const { return p.y + 1.875f; }
	float YMin() const { return p.y - 1.875f; }
	float ZMax() const { return p.z; }
	float ZMin() const { return p.z; }





	virtual void CreateVAO()
	{
		glGenVertexArrays(1, &m_vao);
		glBindVertexArray(m_vao);

		unsigned int vbo;
		glGenBuffers(1, &vbo);
		glBindBuffer(GL_ARRAY_BUFFER, vbo);
		glBufferData(GL_ARRAY_BUFFER, vertices.size() * sizeof(Vertex), vertices.data(), GL_STATIC_DRAW);

		glVertexAttribPointer(0, 3, GL_FLOAT, GL_FALSE, sizeof(Vertex), NULL);

		glVertexAttribPointer(1, 2, GL_FLOAT, GL_FALSE, sizeof(Vertex), (void*)offsetof(Vertex, s));
		glEnableVertexAttribArray(0);

		glEnableVertexAttribArray(1);
		{
			int width, height, nrChannels;
			std::shared_ptr<unsigned char> pData = std::shared_ptr<unsigned char>(stbi_load("Resources/map.jpg", &width, &height, &nrChannels, 0), stbi_image_free);
			if (!pData)
				throw std::exception("Failed to load texture");

			unsigned texture;
			glGenTextures(1, &texture);
			glActiveTexture(GL_TEXTURE0);
			glBindTexture(GL_TEXTURE_2D, texture);

			glTexParameteri(GL_TEXTURE_2D, GL_TEXTURE_WRAP_S, GL_REPEAT);
			glTexParameteri(GL_TEXTURE_2D, GL_TEXTURE_WRAP_T, GL_REPEAT);
			glTexParameteri(GL_TEXTURE_2D, GL_TEXTURE_MIN_FILTER, GL_LINEAR);
			glTexParameteri(GL_TEXTURE_2D, GL_TEXTURE_MAG_FILTER, GL_LINEAR);

			glTexImage2D(GL_TEXTURE_2D, 0, GL_RGB, width, height, 0, GL_RGB, GL_UNSIGNED_BYTE, pData.get());
			glGenerateMipmap(GL_TEXTURE_2D);
		}

	}
	virtual void Draw(ShaderProgram& shader)
	{
		glUniform1i(glGetUniformLocation(shader.ID, "ourTexture"), 0);
		glBindVertexArray(m_vao);
		glm::mat4 model = glm::mat4(1.0f);
		model = glm::scale(model, glm::vec3(2, 2, 0));




		glUniformMatrix4fv(glGetUniformLocation(shader.ID, "model"), 1, GL_FALSE, glm::value_ptr(model));
		glDrawArrays(GL_TRIANGLE_STRIP, 0, vertices.size());
		glBindVertexArray(0);

	}
};


void key_callback(GLFWwindow* window, int key, int scancode, int action, int mode);
void on_error(int code, const char* text);


//GAMEEe-------------------------------------------------------------------------
class Game
{
	int SCORE = 0;
	int tailSize = 0;
public:
	std::unique_ptr<ShaderProgram> shader;
	std::vector<std::unique_ptr<Snake>> snakeList;

	//std::vector<Tail> tailList;

	//tailList


	glm::mat4 view;
	glm::mat4 projection;




	Map map = Map(glm::vec3(0.f, 0.f, 0.f));//
	Snake snake = Snake(glm::vec3(0.f, 0.f, -0.5f));//
	Food food = Food(glm::vec3(-1.75f, 1.75f, -0.5f));//
	

	//snakeList.push_back(std::make_unique<Snake>(snake);


	void updatePositions()
	{/*
		snake.SetOldPosition(snake.Position());
		if (snakeList.size() >= 1) {
			for (int i = 0; i < snakeList.size(); i++)
			{
				if (i == 0) {
					snakeList.at(0).get()->SetOldPosition(snake.getOldPosition());
				}
				else {
					snakeList.at(i).get()->SetPosition(snakeList.at(i - 1).get()->getOldPosition());
				}
			}
		}*/
		
		if (snakeList.size() >= 1) {

			snakeList.at(0).get()->SetOldPosition(snakeList.at(0).get()->Position());
			snakeList.at(0).get()->SetPosition(snake.Position());

			for (int i = 0; i < snakeList.size(); i++)
			{
				
				
				
				if (snakeList.size() > 1 &&i>=1) {
					{
						if (snakeList.at(i).get()->Position() != snakeList.at(i - 1).get()->getOldPosition()) 
						{
							snakeList.at(i).get()->SetOldPosition(snakeList.at(i).get()->Position());
							snakeList.at(i).get()->SetPosition(snakeList.at(i - 1).get()->getOldPosition());
							

							 
						}
					}
				}
			}
		}

	}

	void addTail() {

	//updatePositions();
		if (snakeList.size() == 0)
		{
			snakeList.push_back(std::make_unique<Snake>(snake.getOldPosition()));
		}
		else {
			snakeList.push_back(std::make_unique<Snake>(snakeList.at(snakeList.size()-1).get()->getOldPosition()));
		}
		//updatePositions();
		
		
	}



	void CreateVAOs()
	{
		shader.reset(new ShaderProgram("Shaders/mvp.vert", "Shaders/fragment.frag"));
		shader->use();
		map.CreateVAO();
		snake.CreateVAO();
		food.CreateVAO();


		//tail.CreateVAO();


	};
	void setCamera()
	{
		view = glm::translate(view, snake.Position() + glm::vec3(0.0f, 0.0f, -5.f));
		view = glm::rotate(view, glm::radians(180.0f), glm::vec3(1.0f, .0f, 0.0f));
		projection = glm::perspective(glm::radians(45.0f), (float)WIDTH / HEIGHT, 1.0f, 1200.0f);

		SetView(view);
		SetProjection(projection);
	};
	void Animate(GLFWwindow* Window, float d)
	{


		

		
		updatePositions();
		snake.Animate(Window, d);

		

	};


	void Draw()
	{
		map.Draw(*shader);
		snake.Draw(*shader);
		food.Draw(*shader);
		//tail.Draw(*shader);

		if (snakeList.size() > tailSize) {
			snakeList.at(tailSize).get()->CreateVAO();
			tailSize++;
		}

		if (snakeList.size() > 0) {
			for (int i = 0; i < snakeList.size(); i++)
			{

				snakeList.at(i).get()->Draw(*shader);
			}
		}




	};

	void checkSnakecollideWithTail(GLFWwindow* Window) {
		bool snakeCollided = false;

		for (int i = 3; i < snakeList.size(); i++) 
		{
			if (snake.XMax() > snakeList.at(i).get()->XMin() && snake.XMin() < snakeList.at(i).get()->XMax()
				&& snake.YMax() > snakeList.at(i).get()->YMin() && snake.YMin() < snakeList.at(i).get()->YMax())
			{
				snakeCollided = true;
			}

			if (snakeCollided) {
				std::cout << "GAME OVER!";
				glfwSetWindowShouldClose(Window, GL_TRUE);
			}

		}




				
			
		
	}
	void checkFoodEaten()
	{//check if snake collided with food
		bool running = true;
		bool notOnSnake;
		/*
		for (int i = 0; i < 10; i++)
		{
			
			int x, y;
			x = rand() % 11 - 4;
			y = rand() % 11 - 4;
			std::cout << x << ":" << y << "///";
		}*/

		if (snake.XMax() > food.XMin() && snake.XMin() < food.XMax()
			&& snake.YMax() > food.YMin() && snake.YMin() < food.YMax()) {
			while (running) 
			{
				//srand(time(0));
				
				srand(GetTickCount());
				int x, y;
				x = rand() % 11 - 4;
				y = rand() % 11 - 4;
				

				//check whether food will spawn on snake if YES gen another random coords:
				if (glm::vec3(x * 0.25f, y * 0.25f, -0.5f) != snake.Position()) 
				{			
					notOnSnake = true;
				}

				else {
					notOnSnake = false; 
					
					break;
				}

				if (snakeList.size() > 0) {
					for (int i = 0; i < snakeList.size(); i++) {
						if (snakeList.at(i).get()->Position() != glm::vec3(x * 0.25f, y * 0.25f, -0.5f))
						{
							notOnSnake = true; 
						}

						else {
							notOnSnake = false;

							
							break;
						}


					}
				}

				if (notOnSnake) {

					food.SetPosition(glm::vec3(x * 0.25f, y * 0.25f, -0.5f));
					std::cout << x << ":" << y << "///";
					std::cout << "speed: " << gameSpeed / 2 << "///";
					running = false;
				}

				//else std::cout << "tried to spawn on snake";
			
				//if(glm::vec3(x * 0.25f, y * 0.25f, -0.5f)!=)


				//food.SetPosition(glm::vec3(x * 0.25f, y * 0.25f, -0.5f));
			}


			if (gameSpeed < 14) {
				gameSpeed++;
			}
			SCORE++;
				std::cout << "SCORE: " << SCORE<<"\n";

			addTail();
			//updatePositions();





		}
		
		//result snake grows and food respawns


	}

	

	void checkIfSnakeOutOfBounds()
	{//check if snake collided with food
		//right wall
		if (snake.XMax() > map.XMax())
		{



			snake.SetPosition(glm::vec3(map.XMin() + 0.125f, snake.getY(), -0.5f));
		}
		//left wall
		if (snake.XMin() < map.XMin()) {

			snake.SetPosition(glm::vec3(map.XMax() - 0.125f, snake.getY(), -0.5f));
		}

		//topwall
		if (snake.YMin() < map.YMin()) {
			snake.SetPosition(glm::vec3(snake.getX(), map.YMax() - 0.125f, -0.5f));
		}
		//bottom wall
		if (snake.YMax() > map.YMax()) {
			snake.SetPosition(glm::vec3(snake.getX(), map.YMin() + 0.125f, -0.5f));

		}
		




		//result snake grows and food respawns


	}


	void SetView(const glm::mat4& view) { glUniformMatrix4fv(glGetUniformLocation(shader->ID, "view"), 1, GL_FALSE, glm::value_ptr(view)); }
	void SetProjection(const glm::mat4& proj) { glUniformMatrix4fv(glGetUniformLocation(shader->ID, "projection"), 1, GL_FALSE, glm::value_ptr(proj)); }

	~Game()
	{
	};
};




//----------------------------------------------------------------------------
int main()
{
	std::cout << "Starting GLFW context, OpenGL 3.3" << std::endl;





	//std::vector<unique_ptr<Snake>> tailList[225];

	//Tail t[6];

	glfwInit();

	try
	{
		stbi_set_flip_vertically_on_load(true);

		glfwSetErrorCallback(on_error);

		glfwWindowHint(GLFW_CONTEXT_VERSION_MAJOR, 3);
		glfwWindowHint(GLFW_CONTEXT_VERSION_MINOR, 3);
		glfwWindowHint(GLFW_OPENGL_PROFILE, GLFW_OPENGL_CORE_PROFILE);
		glfwWindowHint(GLFW_RESIZABLE, GL_FALSE);

		GLFWwindow* window = glfwCreateWindow(WIDTH, HEIGHT, "OpenGL Window", NULL, NULL);
		glfwMakeContextCurrent(window);
		if (window == NULL)
			throw std::exception("Failed to create GLFW window");


		if (!gladLoadGLLoader((GLADloadproc)glfwGetProcAddress))
			throw std::exception("Failed to initialize OpenGL context");

		glViewport(0, 0, WIDTH, HEIGHT);
		glEnable(GL_DEPTH_TEST);



		Game Game;
		glfwSetWindowUserPointer(window, (void*)&Game);
		glfwSetKeyCallback(window, key_callback);

		Game.CreateVAOs();
		Game.setCamera();

		float newdt = (float)glfwGetTime();
		float olddt = (float)glfwGetTime();
		float delta = newdt - olddt;
		float timeCount = 0.0f;
		while (!glfwWindowShouldClose(window))
		{
			
			newdt = (gameSpeed / 2) * glfwGetTime();
			delta = newdt - olddt;
			olddt = newdt;
			timeCount += delta;
			
			glClearColor(0.1f, 0.1f, 0.1f, 1.0f);
			glClear(GL_COLOR_BUFFER_BIT | GL_DEPTH_BUFFER_BIT);
			if (timeCount >= 1) {

				timeCount = 0.1f;
				//snakeHeadOldPos = Game.snake.Position();
				Game.Animate(window, timeCount);


			}
			Game.Draw();
			Game.checkFoodEaten();
			Game.checkIfSnakeOutOfBounds();
			Game.checkSnakecollideWithTail(window);
			

			glfwSwapBuffers(window);
			olddt = newdt;
			glfwPollEvents();


		}

	}
	catch (std::exception& e)
	{
		std::cout << "Unexpected error: " << e.what() << std::endl;
		std::cin.get();
	}

	glfwTerminate();

	return 0;
}

void key_callback(GLFWwindow* window, int key, int scancode, int action, int mode)
{
	if (glfwGetKey(window, GLFW_KEY_LEFT) == GLFW_PRESS && lastpressedKey != 2)
	{
		//result.x += -2.5;
		lastpressedKey = 1;
		//std::cout << "x-";
	}

	else if (glfwGetKey(window, GLFW_KEY_RIGHT) == GLFW_PRESS && lastpressedKey != 1)
	{
		//result.x += 2.5;
		lastpressedKey = 2;
		//std::cout << "x+";
	}

	else if (glfwGetKey(window, GLFW_KEY_UP) == GLFW_PRESS && lastpressedKey != 4)
	{
		//result.y += -2.5;
		lastpressedKey = 3;

		//std::cout << "y-";
	}

	else if (glfwGetKey(window, GLFW_KEY_DOWN) == GLFW_PRESS && lastpressedKey != 3)
	{
		//result.y += 2.5;
		lastpressedKey = 4;
		//std::cout << "y+";
	}


	std::cout << key << std::endl;
	if (key == GLFW_KEY_ESCAPE && action == GLFW_PRESS)
		glfwSetWindowShouldClose(window, GL_TRUE);
}

void on_error(int code, const char* text)
{
	std::cout << "Error code: " << code << " Error text: " << text << std::endl;
}