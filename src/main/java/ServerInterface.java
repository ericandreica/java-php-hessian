public interface ServerInterface {
    String getByName(String name);
    String getByContentString(String content);
    String getByContentBytes(String bytes);
    String getByHash(String hash);
    String listAll();
}
